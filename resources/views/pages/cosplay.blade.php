@extends('layouts.blank')

@section('header')
    <script>
        var socket = io.connect('http://z11:3000');
    </script>
    @include('layouts.header')
@endsection

@section('content')
    <div class="content">
        <style>
            .active {
                color: #1fa357!important;
                font-weight: bold;
            }
            .title-cosplay .r-part{
                color: #fff;
                font-weight: normal;
            }
        </style>

        <div class="bg-cosplay cosplay-div">
            <p class="title-cosplay tabs">
                <span data-target="cosplay-new" class="l-part">{{ __('l.new') }}</span>
                <span data-target="cosplay-best" class="r-part">{{ __('l.cosplay_best') }}</span>
            </p>
            <div id="cosplay-new" class="cosplay-list-one tab">
                @foreach($cosplays as $cosplay)
                    <div class="item-cosplay">
                        <img class="img" src="{{ $cosplay->origin_url }}" alt="">
                        <ul class="marks">
                            <li idImage="{{ $cosplay->id }}" class="like {{ isset($cookieCosplay[$cosplay->id]) && $cookieCosplay[$cosplay->id] == 'like' ? 'active' : '' }}"><span></span></li>
                            <li idImage="{{ $cosplay->id }}" class="dislike {{ isset($cookieCosplay[$cosplay->id]) && $cookieCosplay[$cosplay->id] == 'dislike' ? 'active' : '' }}"><span></span></li>
                        </ul>
                    </div>
                @endforeach
            </div>
            <div id="cosplay-best" style="display: none" class="cosplay-list-two tab">
                @foreach($cosplaysBest as $cosplay)
                    <div class="item-cosplay">
                        <img class="img" src="{{ $cosplay->origin_url }}" alt="">
                        <ul class="marks">
                            <div class="like-count"><span>{{ $cosplay->likes }}</span></div>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
		    $('.tabs span').click(function () {
			    $('.tabs span').removeClass('active');
			    $(this).addClass('active');
			    $('.tab').hide();
			    $(`#${$(this).data('target')}`).show();
			    $('.cosplay-list-two').get(0).slick.setPosition()
		    })

		    // $(document).ready(function () {
		    //     $('.cosplay-list-two').hide()
		    // })
        </script>

        <div class="best-cosplay cosplay-div">
            <p class="title-cosplay">{{ __('l.which_better') }}</p>
            <div id="whoBetter" class="cosplay-list-three" style="display: flex; flex-direction: row;">
            </div>
        </div>
    </div>
    <script>
	    let data = '{!! json_encode($cosplays->sortBy('id')->pluck('origin_url', 'id')) !!}';
	        data = JSON.parse(data);

	    let stages0  = arraySplitter( Object.entries(data), 0); // 81
        let stages1 = []; // 27
        let stages2 = []; // 9
        let stages3 = []; // 3

        function arraySplitter(data, stage) {
        	let globalArray = [];
        	let amountOfImages;

	        if  (stage == 0)
		        amountOfImages = 26;
	        if  (stage == 1)
		        amountOfImages = 8;
	        if  (stage == 2)
		        amountOfImages = 2;

        	for (let i=0; i<amountOfImages; i++) {
        		let timeArray = [];
                for (let x=0; x<3; x++) {
	                timeArray.push(data[x]);
	                data.splice(0, 1)
                }
                globalArray.push(timeArray);
            }
	        globalArray.push(data);

        	return globalArray;
        }

        function addPoll(players, numArray = 0, stage = 0) {
	        $('#whoBetter').html('');

            for (let i=0; i < players.length; i++) {
                $('#whoBetter').append(
                    `<div stage="${stage}" num="${numArray}" class="item-cosplay">` +
                    `   <img idImage="${players[i][0]}" class="img" src="${players[i][1]}" alt="" onclick="selectWinner(${i}, ${numArray}, ${stage}, this)">` +
                    `   <div class="best-point">` +
                    `   <span idImage="${players[i][0]}" class="like" onclick="selectWinner(${i}, ${numArray}, ${stage}, this)"></span>` +
                    `   </div>` +
                    `</div>`)
            }
        }

        function selectWinner(imageIDinArray, numArray, stage = 0, element) {
        	if  (stage == 0 && numArray+1 == 27 || stage == 1 && numArray+1 == 9 || stage == 2 && numArray+1 == 3 || stage == 3) {
        		stage = stage +1;
		        numArray = 0;

		        if  (stage == 1) {
			        /*
			        if in array 26 items -> nex poll will get numArray = 26
			        so if 26+1 == 27 <= because of this we call arraySplitter function before add item to array
			         */
			        stages1.push(stages0[numArray][imageIDinArray]);
			        console.log('BEFORE SPLIT STAGE 1', stages1);
		            stages1 = arraySplitter(stages1, stage);
			        console.log('AFTER SPLIT STAGE 1', stages1);
			        addPoll(stages1[numArray], numArray, stage)
		        }
		        if  (stage == 2) {
			        stages2.push(stages1[numArray][imageIDinArray]);
			        console.log('BEFORE SPLIT STAGE 2', stages2);
			        stages2 = arraySplitter(stages2, stage);
			        console.log('AFTER SPLIT STAGE 2', stages2);
			        addPoll(stages2[numArray], numArray, stage)
		        }
		        if  (stage == 3) {
			        stages3.push(stages2[numArray][imageIDinArray]);
			        console.log('BEFORE SPLIT STAGE 3', stages3);
			        stages3 = arraySplitter(stages3, stage);
			        console.log('AFTER SPLIT STAGE 3', stages3);
			        addPoll(stages3[numArray], numArray, stage)
		        }
		        if  (stage == 4) {
			        console.log(stages3[numArray])
			        console.log(stages3[numArray][imageIDinArray])
			        winner(stages3[numArray][imageIDinArray])
		        }

		        return;
            }

	        console.log(stage, numArray, imageIDinArray);

        	if  (stage == 0) {
		        stages1.push(stages0[numArray][imageIDinArray]);
		        addPoll(stages0[numArray + 1], numArray + 1, stage)
	        }
        	if  (stage == 1) {
		        stages2.push(stages1[numArray][imageIDinArray]);
		        addPoll(stages1[numArray + 1], numArray + 1, stage)
            }
        	if  (stage == 2) {
		        stages3.push(stages2[numArray][imageIDinArray]);
		        addPoll(stages2[numArray + 1], numArray + 1, stage)
	        }

	        console.log(stages1, stages2, stages3);


	        // console.log(stages1, stages2, stages3)


	        postLike( $(element).attr('idImage'), 'like', true );
        }

        function winner(arrayOfWinner)
        {
	        $('#whoBetter').html(
		        `<div class="item-cosplay">` +
		        `   <img class="img" src="${arrayOfWinner[1]}" alt=""` +
		        `   <div class="best-point">` +
		        `   <span>{{ __('l.thx_poll') }}</span>` +
		        `   </div>` +
		        `</div>`)
        }

	    console.log( stages0)
        addPoll( stages0[0] )

        // console.log( arraySplitter( Object.entries(data)) )


        // console.log( arraySplitter(data) )
    </script>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
