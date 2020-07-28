<div id="match_live_container" style="display: block;">
@if (!isset($dataLive) || !is_array($dataLive) || empty($dataLive))

@else
    @foreach ($dataLive as $liveMatchKey => $liveMatch)
        <li class="live open">
            <div class="match-item" onclick="$('.match-list-info li').removeClass('focus');$(this).parent().addClass('focus');force_change_channel({{$liveMatchKey}});waitingEnd();">
                <div class="leftTeam {{($liveMatch->radiant_lead > 0) ? 'win' : ''}}">
                    <span class="nameTeam">{{ $liveMatch->team_name_radiant }}</span>
                    <div class="imgTeam" onclick="location.href='/{{App::getLocale()}}/team/{{$liveMatch->team_id_radiant}}';">
                        <img src="{{ ($liveMatch->team_id_radiant) ? '/img/team/'.$liveMatch->team_id_radiant.'.png' : '' }}" alt="">
                    </div>
                    <ul class="shields">
                        {!!($liveMatch->fb_flag == 2) ? '<li class="green">fb</li>' : '<li class=""></li>'!!}
                        {!!($liveMatch->k10_flag == 2) ? '<li class="grey">10</li>' : '<li class=""></li>'!!}
                        {!!($liveMatch->roshan_kill_flag == 2) ? '<li class="red">r</li>' : '<li class=""></li>'!!}
                    </ul>
                </div>
                <div class="centerTime">
                    <span class="timeTeam">{{ $liveMatch->minutes }}:{{ (strlen($liveMatch->seconds) == 1) ? '0'.$liveMatch->seconds : $liveMatch->seconds }}</span>
                    <span class="points {{($liveMatch->radiant_lead > 0) ? 'a-left' : (($liveMatch->radiant_lead < 0) ? 'a-right' : '')}}">{{str_replace('-','',$liveMatch->radiant_lead)}}</span>
                    <div>
                        <span class="mapTeamScore">{{$liveMatch->radiant_win_in_series}}</span>
                        <span class="mapTeam">map {{$liveMatch->number_in_series}}</span>
                        <span class="mapTeamScore">{{$liveMatch->dire_win_in_series}}</span>
                    </div>
                </div>
                <div class="rightTeam {{($liveMatch->radiant_lead < 0) ? 'win' : ''}}">
                    <span class="nameTeam">{{ $liveMatch->team_name_dire }}</span>
                    <div class="imgTeam" onclick="location.href='/{{App::getLocale()}}/team/{{$liveMatch->team_id_dire}}';">
                        <img src="{{ ($liveMatch->team_id_dire) ? '/img/team/'.$liveMatch->team_id_dire.'.png' : '' }}" alt="">
                    </div>
                    <ul class="shields">
                        {!!($liveMatch->fb_flag == 3) ? '<li class="green">fb</li>' : '<li class=""></li>'!!}
                        {!!($liveMatch->k10_flag == 3) ? '<li class="grey">10</li>' : '<li class=""></li>'!!}
                        {!!($liveMatch->roshan_kill_flag == 3) ? '<li class="red">r</li>' : '<li class=""></li>'!!}
                    </ul>
                </div>
            </div>
        </li>
    @endforeach
@endif
</div>
<script>
    function waitingEnd()
    {
        match_waiting_container = document.querySelector('#match_waiting_container');
        match_waiting_container.setAttribute("style", "display: none;");
        match_display_container = document.querySelector('#match_display_container');
        match_display_container.setAttribute("style", "display:block;");
    }
    socket.on('matches_live', function(data){

	    console.log(data)




	    //Get new data
	    let arrayForCheckLocalStorage = [];

	    if (typeof data !== 'undefined' && typeof data['data'] !== 'undefined') {
		    len = data['data'].length;
		    if (typeof len !== 'undefined' || len > 0) {
			    for (i = 0; i < len; i++) {
				    arrayForCheckLocalStorage.push({
					    'radiant': {
						    'fb': (data['data'][i]['fb_flag'] == 2) ? true : false,
						    '10': (data['data'][i]['k10_flag'] == 2) ? true : false,
						    'rosh': (data['data'][i]['roshan_kill_flag'] == 2) ? true : false,
					    },
					    'dire': {
						    'fb': (data['data'][i]['fb_flag'] == 3) ? true : false,
						    '10': (data['data'][i]['k10_flag'] == 3) ? true : false,
						    'rosh': (data['data'][i]['roshan_kill_flag'] == 3) ? true : false,
					    }
				    });
			    }
		    }
	    }


	    let storage = JSON.parse(localStorage.getItem('live_data'));

	    if  (storage == null) {
		    localStorage.setItem('live_data', JSON.stringify(arrayForCheckLocalStorage));
		    storage = JSON.parse(localStorage.getItem('live_data'));
	    }
	    //Check new data VS previous data
	    let arrayToUseForSounds = {
	    	'radiant': {
			    'fb': storage[current_channel]['radiant']['fb'] == arrayForCheckLocalStorage[current_channel]['radiant']['fb'],
			    '10': storage[current_channel]['radiant']['10'] == arrayForCheckLocalStorage[current_channel]['radiant']['10'],
			    'rosh': storage[current_channel]['radiant']['rosh'] == arrayForCheckLocalStorage[current_channel]['radiant']['rosh'],
		    },
	    	'dire': {
			    'fb': storage[current_channel]['dire']['fb'] == arrayForCheckLocalStorage[current_channel]['dire']['fb'],
			    '10': storage[current_channel]['dire']['10'] == arrayForCheckLocalStorage[current_channel]['dire']['10'],
			    'rosh': storage[current_channel]['dire']['rosh'] == arrayForCheckLocalStorage[current_channel]['dire']['rosh'],
		    }
        };
	    // console.log(arrayToUseForSounds)


        match_live_container = document.querySelector('#match_live_container');
        match_live_container.innerHTML = "";
        if (typeof data !== 'undefined' && typeof data['data'] !== 'undefined')
        {
            len = data['data'].length;
	        // console.log(data, len);
	        if (typeof len !== 'undefined' || len > 0)
            {
                keys = Object.keys(data['data'])
                for (i = 0; i < len; i++) {

                    li = document.createElement("li");
                    match_live_container.appendChild(li);
                    li.setAttribute("class", "live open");
                    div0 = document.createElement("div");
                    li.appendChild(div0);
                    div0.setAttribute("class", "match-item");
                    div0.setAttribute("onclick", "$('.match-list-info li').removeClass('focus');$(this).parent().addClass('focus');force_change_channel("+i+");waitingEnd();");
                    div00 = document.createElement("div");
                    div0.appendChild(div00);
                    div00.setAttribute("class", "leftTeam");
                    div01 = document.createElement("div");
                    div0.appendChild(div01);
                    div01.setAttribute("class", "centerTime");
                    div02 = document.createElement("div");
                    div0.appendChild(div02);
                    div02.setAttribute("class", "rightTeam");
                    if (data['data'][i]['radiant_lead'] > 0)
                        div00.setAttribute("class", div00.getAttribute("class")+" win");
                    else if (data['data'][i]['radiant_lead'] < 0)
                        div02.setAttribute("class", div02.getAttribute("class")+" win");
                    span000 = document.createElement("span");
                    div00.appendChild(span000);
                    span000.setAttribute("class", "nameTeam");
                    span000.innerHTML = data['data'][i]['team_name_radiant'];
                    div000 = document.createElement("div");
                    div00.appendChild(div000);
                    div000.setAttribute("class", "imgTeam");
                    div000.setAttribute("onclick", "location.href='/{{App::getLocale()}}/team/"+data['data'][i]['team_id_radiant']+"';");
                    img0000 = document.createElement("img");
                    div000.appendChild(img0000);
                    if (data['data'][i]['team_id_radiant'])
                        img0000.setAttribute("src", "/img/team/"+data['data'][i]['team_id_radiant']+".png");
                    ul000 = document.createElement("ul");
                    div00.appendChild(ul000);
                    ul000.setAttribute("class", "shields");
                    li0000 = document.createElement("li");
                    ul000.appendChild(li0000);
                    li0001 = document.createElement("li");
                    ul000.appendChild(li0001);
                    li0002 = document.createElement("li");
                    ul000.appendChild(li0002)
                    if (data['data'][i]['fb_flag'] == "2")
                    {
	                    if (!arrayToUseForSounds['radiant']['fb'])
	                    	makeSound('{{ asset('audio/' .app()->getLocale(). '/fb_rd.mp3') }}');

                        li0000.setAttribute("class", "green");
                        li0000.innerHTML = 'fb';
                    }
                    if (data['data'][i]['k10_flag'] == "2")
                    {
	                    if (!arrayToUseForSounds['radiant']['10'])
		                    makeSound('{{ asset('audio/' .app()->getLocale(). '/10_rd.mp3') }}');

                        li0001.setAttribute("class", "grey");
                        li0001.innerHTML = '10';
                    }
                    if (data['data'][i]['roshan_kill_flag'] == "2")
                    {
	                    if (!arrayToUseForSounds['radiant']['rosh'])
		                    makeSound('{{ asset('audio/' .app()->getLocale(). '/rosh_rd.mp3') }}');

                        li0002.setAttribute("class", "red");
                        li0002.innerHTML = 'r';
                    }
                    span020 = document.createElement("span");
                    div02.appendChild(span020);
                    span020.setAttribute("class", "nameTeam");
                    span020.innerHTML = data['data'][i]['team_name_dire'];
                    div020 = document.createElement("div");
                    div02.appendChild(div020);
                    div020.setAttribute("class", "imgTeam");
                    div020.setAttribute("onclick", "location.href='/{{App::getLocale()}}/team/"+data['data'][i]['team_id_dire']+"';");
                    img0200 = document.createElement("img");
                    div020.appendChild(img0200);
                    if (data['data'][i]['team_id_dire'])
                        img0200.setAttribute("src", "/img/team/"+data['data'][i]['team_id_dire']+".png");
                    ul020 = document.createElement("ul");
                    div02.appendChild(ul020);
                    ul020.setAttribute("class", "shields");
                    li0200 = document.createElement("li");
                    ul020.appendChild(li0200);
                    li0201 = document.createElement("li");
                    ul020.appendChild(li0201);
                    li0202 = document.createElement("li");
                    ul020.appendChild(li0202);
                    if (data['data'][i]['fb_flag'] == "3")
                    {
	                    if (!arrayToUseForSounds['dire']['fb'])
		                    makeSound('{{ asset('audio/' .app()->getLocale(). '/fb_dr.mp3') }}');

                        li0200.setAttribute("class", "green");
                        li0200.innerHTML = 'fb';
                    }
                    if (data['data'][i]['k10_flag'] == "3")
                    {
	                    if (!arrayToUseForSounds['dire']['10'])
		                    makeSound('{{ asset('audio/' .app()->getLocale(). '/10_dr.mp3') }}');

                        li0201.setAttribute("class", "grey");
                        li0201.innerHTML = '10';
                    }
                    if (data['data'][i]['roshan_kill_flag'] == "3")
                    {
	                    if (!arrayToUseForSounds['dire']['rosh'])
		                    makeSound('{{ asset('audio/' .app()->getLocale(). '/rosh_dr.mp3') }}');

                        li0202.setAttribute("class", "red");
                        li0202.innerHTML = 'r';
                    }
                    span010 = document.createElement("span");
                    div01.appendChild(span010);
                    span010.setAttribute("class", "timeTeam");
                    span010.innerHTML = data['data'][i]['radiant_score']+":"+data['data'][i]['dire_score'];
                    if (data['data'][i]['seconds'].length == 1)
                        span010.innerHTML = data['data'][i]['minutes']+":"+'0'+data['data'][i]['seconds'];
                    else
                        span010.innerHTML = data['data'][i]['minutes']+":"+data['data'][i]['seconds'];
                    span011 = document.createElement("span");
                    div01.appendChild(span011);
                    span011.setAttribute("class", "points ");
                    span011.innerHTML = data['data'][i]['radiant_lead'].replace("-", "");
                    if (data['data'][i]['radiant_lead'] < 0)
                        span011.setAttribute("class", span011.getAttribute("class")+" a-right");
                    else if (data['data'][i]['radiant_lead'] > 0)
                        span011.setAttribute("class", span011.getAttribute("class")+" a-left");
                    div010 = document.createElement("div");
                    div01.appendChild(div010);
                    span0100 = document.createElement("span");
                    div010.appendChild(span0100);
                    span0100.setAttribute("class", "mapTeamScore");
                    span0100.innerHTML = data['data'][i]['radiant_win_in_series'];
                    span0101 = document.createElement("span");
                    div010.appendChild(span0101);
                    span0101.setAttribute("class", "mapTeam");
                    span0101.innerHTML = 'map '+data['data'][i]['number_in_series'];
                    span0102 = document.createElement("span");
                    div010.appendChild(span0102);
                    span0102.setAttribute("class", "mapTeamScore");
                    span0102.innerHTML = data['data'][i]['dire_win_in_series'];
                }

            } else if (data['data'] === false)
            {
                $(".menu-side-v2 .link-live").removeClass("active");
                $(".match-list-info .live").removeClass("open");
                $(".match-list-info .future").addClass("open");
                document.getElementById("match_live_container").setAttribute("style", "display: none;");
                document.getElementById("match_future_container").setAttribute("style", "display: block;");
                $(".menu-side-v2 .link-future").addClass("active");
                no_matches_banner_container = document.querySelector('#twitch-embed');
                no_matches_banner_container.innerHTML = '';
                no_matches_div = document.createElement("div");
                no_matches_banner_container.appendChild(no_matches_div);
                no_matches_div.setAttribute("class", "no_matches_banner");
            }

        }

	    //save already used data for not replay sound that played
	    localStorage.setItem('live_data', JSON.stringify(arrayForCheckLocalStorage));
    })
</script>
