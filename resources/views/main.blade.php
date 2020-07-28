@extends('layouts.blank')

@section('header')
    <script>
        var socket = io.connect('https://z11.live:3000');
    </script>
    @include('layouts.header')
@endsection

@section('content')
    <div class="content">

        <div class="side-container">
            <div class="side-online">
                <a href="{{ route('main.results', App::getLocale()) }}" class="result-Btn">{{ __('l.results_page') }}</a>
                <div class="menu-side-v2">
                    <ul>
                        <li class="active link-chat"><a href="#">{{ __('l.chat') }}</a></li>
                        <li class="link-last"><a href="#">{{ __('l.past') }}</a></li>
                    </ul>
                </div>
                <div class="box-shadow">
                    <ul class="listMess">
                        @foreach($messages as $message)
                            <li>
                                <span class="time">{{ date('H:i', strtotime($message->created_at)) }}</span> <span style="cursor: pointer" onclick="addNameToChat(this)" class="user">{{ $message->isAdmin() ? $message->login . ' | Admin' : $message->login }}</span>
                                <p style="{{ $message->isAdmin() ? 'color: red' : '' }}">{!! preg_replace('/\@([a-zA-z0-9]+)\b/', '-> <span style="color: green;">$1</span>', $message->message)  !!}</p>
                            </li>
                        @endforeach
                    </ul>

                    @if($logged)
                        <form id="sendMessage" class="login-form" action="{{ route('chat.store') }}" method="post">
                            @csrf

                            <div class="inputs">
                                <textarea id="message" onkeypress="return ifPressedEnter(event)" required name="message" class="input" style="color: #fff" placeholder="Type text"></textarea>
                            </div>
                            <input type="submit" class="submit" value="">
                            <ul class="list-unstyled">
                                <li>Login: {{ $logged['login'] }}</li>
                                <li>Email: {{ $logged['email'] }}</li>
                            </ul>
                            <a href="{{ route('chat.logout') }}" class="btn btn-danger">logout</a>
                        </form>
                    @else
                        <form class="login-form" action="{{ route('chat.login') }}" method="post">
                            @csrf

                            <div class="inputs">
                                <input type="text" name="login" class="input" style="color: #fff" placeholder="Ваш логин">
                                <input type="email" name="email" class="input" style="color: #fff" placeholder="Ваш Email">
                            </div>
                            <input type="submit" class="submit" value="Вход">
                        </form>
                    @endif

                    @include('layouts.match_past')
                </div>
            </div>
            <div class="side-info">
                <a href="{{ route('main.schedule', App::getLocale()) }}" class="result-Btn">{{ __('l.schedule_page') }}</a>
                <div class="menu-side-v2">
                    <ul>
                        <li class="link-live active"><a href="#">{{ __('l.live') }}</a></li>
                        <li class="link-future "><a href="#">{{ __('l.future') }}</a></li>
                    </ul>
                </div>
                <ul class="match-list-info">
                    @include('layouts.match_live')

                    @include('layouts.match_future')
                </ul>
@if (!isset($dataLive) || !is_array($dataLive) || empty($dataLive))
<script>
    $(".menu-side-v2 .link-live").removeClass("active");
    $(".match-list-info .live").removeClass("open");
    $(".match-list-info .future").addClass("open");
    document.getElementById("match_live_container").setAttribute("style", "display: none;");
    document.getElementById("match_future_container").setAttribute("style", "display: block;");
    $(".menu-side-v2 .link-future").addClass("active");
</script>
@endif
            </div>
        </div>
        @include('layouts.match_display')

        @include('layouts.match_banners')
    </div>


    <script>
        function addNameToChat(el) {
	        console.log( $(el).html() )
            let name = $(el).html().replace(' | Admin', '');
	        $('#message').val('@'+name+' ');
	        $('#message').focus();
        }

	    $('#sendMessage').submit(function(e) {
		    e.preventDefault(); // prevents page reloading
		    sendData();
	    });

	    function ifPressedEnter(e) {
		    if (e.keyCode == 13) {
		    	sendData();
			    return false;
		    }
        }

	    function sendData() {
		    let data = {
			    '_token': '{{ csrf_token() }}',
			    'login': "{{ $logged['login'] ?? null }}",
			    'email': "{{ $logged['email'] ?? null }}",
			    'message': $('#message').val(),
		    };

		    $.ajax({
			    method: 'POST',
			    url: "{{ route('chat.store') }}",
			    data: data,
			    success: (resp) => {
				    socket.emit('chat-message', resp)
			    }
		    });

		    $('#message').val('');
	    }


	    socket.on('chat-message', function(data){
		    let time = new Date(data.created_at);

		    $('.listMess').append(`
            <li>
                <span class="time">${time.getHours()}:${ (time.getMinutes()<10?'0':'') + time.getMinutes()}</span> <span style="cursor: pointer" onclick="addNameToChat(this)" class="user">${data.login}</span>
                <p style="${data.login.includes('Admin') ? 'color: red;' : ''}">${data.message}</p>
            </li>`);

		    $('.listMess li')[0].remove();
	    })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.1/howler.min.js"></script>
    <script>
	    function makeSound(soundName) {
		    var sound = new Howl({
			    src: [soundName],
			    volume: localStorage.getItem('volume') == null ? 0.7 : localStorage.getItem('volume'),
			    // onend: function () {
			    //     alert('Finished!');
			    // }
		    });
		    sound.play()
	    }
    </script>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
