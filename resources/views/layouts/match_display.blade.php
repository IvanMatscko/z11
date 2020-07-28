<div class="side-rate" style="position: relative">
    @include('layouts.match_display_top_banner')

    @include('layouts.match_past_popup')

    @if (!isset($dataLive[$activeMatchNumber]))
    <div class="match-waiting" id="match_waiting_container">

    </div>
    <div class="match-open" id="match_display_container" style="display: none;">
        <div class="match-header">
            <div class="leftTeam" id="radiant_team_container">
                <span class="data"><div id="match_display_radiant_score_container"></div><i id="match_display_radiant_lead_container"></i></span>

                <div class="teamImg">
                    <img id="match_display_radiant_team_logo_container" src="" alt="">
                </div>
            </div>

            <div class="centerTime"><span class="timeTeam" id="match_display_time_container"></span></div>

            <div class="rightTeam" id="dire_team_container">
                <span class="data"><div id="match_display_dire_score_container"></div><i id="match_display_dire_lead_container"></i></span>

                <div class="teamImg">
                    <img id="match_display_dire_team_logo_container" src="" alt="">
                </div>
            </div>
        </div>

        <div class="match-details">
            <div class="leftTeam">
                <ul>
                    @for ($i = 0; $i < 5; $i++)
                        <li>
                            <p><a href="" class="namePl" id="match_display_player_{{$i}}_name_container"></a></p>
                            <div class="size57 hero-avatar" id="match_display_player_{{$i}}_avatar_container" style="">
                                <a href="" id="match_display_player_{{$i}}_link_container"></a>
                            </div>
                            <div class="dopInfo">
                                <ul class="listG">
                                    <li class="g" id="match_display_player_{{$i}}_kill_container"></li>
                                    <li class="r" id="match_display_player_{{$i}}_death_container"></li>
                                    <li class="b" id="match_display_player_{{$i}}_assists_container"></li>
                                </ul>
                            </div>
                            <span class="ellipse" id="match_display_player_{{$i}}_level_container"></span>
                        </li>
                    @endfor
                </ul>
            </div>

            <div class="centerDetails">

                <div class="graphDiv">
                    <script>
                        var graph_labels = ["0","1"];
                        var graph_data = ["0","1"];
                    </script>
                    <div id="holder"></div>
                </div>

                <div class="mapDiv">
                    <div id="canvas"></div>
                </div>
                <script src="/js/bstate.js"></script>

            </div>

            <div class="rightTeam">
                <ul>
                    @for ($i = 5; $i < 10; $i++)
                        <li>
                            <p><a href="" class="namePl" id="match_display_player_{{$i}}_name_container"></a></p>
                            <div class="dopInfo">
                                <ul class="listG">
                                    <li class="g" id="match_display_player_{{$i}}_kill_container"></li>
                                    <li class="r" id="match_display_player_{{$i}}_death_container"></li>
                                    <li class="b" id="match_display_player_{{$i}}_assists_container"></li>
                                </ul>
                            </div>
                            <div class="size57 hero-avatar" id="match_display_player_{{$i}}_avatar_container" style="">
                                <a href="" id="match_display_player_{{$i}}_link_container"></a>
                            </div>
                            <span class="ellipse" id="match_display_player_{{$i}}_level_container"></span>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
    @else
    <div class="match-waiting" id="match_waiting_container" style="display: none;">

    </div>
    <div class="match-open" id="match_display_container">
        <div class="match-header">
            <div class="leftTeam" id="radiant_team_container">
                <span class="data"><div id="match_display_radiant_score_container">{{$dataLive[$activeMatchNumber]->radiant_score}}</div><i id="match_display_radiant_lead_container">{{ ($dataLive[$activeMatchNumber]->radiant_lead > 0)?$dataLive[$activeMatchNumber]->radiant_lead:''}}</i></span>

                <div class="teamImg">
                    <img id="match_display_radiant_team_logo_container" src="{{ ($dataLive[$activeMatchNumber]->team_id_radiant) ? '/img/team/'.$dataLive[$activeMatchNumber]->team_id_radiant.'.png' : '' }}" alt="">
                </div>
            </div>

            <div class="centerTime"><span class="timeTeam" id="match_display_time_container">{{ $dataLive[$activeMatchNumber]->minutes }}:{{ (strlen($dataLive[$activeMatchNumber]->seconds) == 1) ? '0'.$dataLive[$activeMatchNumber]->seconds : $dataLive[$activeMatchNumber]->seconds }}</span></div>

            <div class="rightTeam" id="dire_team_container">
                <span class="data"><div id="match_display_dire_score_container">{{$dataLive[$activeMatchNumber]->dire_score}}</div><i id="match_display_dire_lead_container">{{ ($dataLive[$activeMatchNumber]->radiant_lead < 0)?str_replace('-','',$dataLive[$activeMatchNumber]->radiant_lead):''}}</i></span>

                <div class="teamImg">
                    <img id="match_display_dire_team_logo_container" src="{{ ($dataLive[$activeMatchNumber]->team_id_dire) ? '/img/team/'.$dataLive[$activeMatchNumber]->team_id_dire.'.png' : '' }}" alt="">
                </div>
            </div>
        </div>

        <div class="match-details">
            <div class="leftTeam">
                <ul>
                @if (!isset($realtimeStats) || empty($realtimeStats))

                @else
                    @for ($i = 0; $i < 10; $i++)

                        @if ($realtimeStats->{$i.'_team'} == 2)
                            <li>
                                <p><a href="/{{App::getLocale()}}/player/{{(isset($realtimeStats->{$i.'_accountid'}) && $realtimeStats->{$i.'_accountid'})?$realtimeStats->{$i.'_accountid'}:''}}" class="namePl" id="match_display_player_{{$i}}_name_container">{{ $realtimeStats->{$i.'_name'} }}</a></p>
                                <div class="size57 hero-avatar" id="match_display_player_{{$i}}_avatar_container" {!!(isset($realtimeHeroes[$realtimeStats->{$i.'_accountid'}]) && $realtimeHeroes[$realtimeStats->{$i.'_accountid'}])?'style="background-image: url(/img/heroes/'.$realtimeHeroes[$realtimeStats->{$i.'_accountid'}].'_vertical.png)':''!!}">
                                    <a href="/{{App::getLocale()}}/player/{{(isset($realtimeStats->{$i.'_accountid'}) && $realtimeStats->{$i.'_accountid'})?$realtimeStats->{$i.'_accountid'}:''}}" id="match_display_player_{{$i}}_link_container"></a>
                                </div>
                                <div class="dopInfo">
                                    <ul class="listG">
                                        <li class="g" id="match_display_player_{{$i}}_kill_container">{{ $realtimeStats->{$i.'_kill_count'} }}</li>
                                        <li class="r" id="match_display_player_{{$i}}_death_container">{{ $realtimeStats->{$i.'_death_count'} }}</li>
                                        <li class="b" id="match_display_player_{{$i}}_assists_container">{{ $realtimeStats->{$i.'_assists_count'} }}</li>
                                    </ul>
                                </div>
                                <span class="ellipse" id="match_display_player_{{$i}}_level_container">{{ $realtimeStats->{$i.'_level'} }}</span>
                            </li>
                        @endif
                    @endfor
                @endif
                </ul>
            </div>

            <div class="centerDetails">
                <div id="graphInMain">
                    <div class="graphDiv">
                        <script>

                            @if (!isset($realtimeStats->graph_data) || empty($realtimeStats->graph_data))

                            @else
                                {!!'var graph_labels = ["'.implode('","',array_keys($realtimeStats->graph_data)).'","128"];'!!}
                                {!!'var graph_data = ["'.implode('","',$realtimeStats->graph_data).'","'.$dataLive[$activeMatchNumber]->radiant_lead.'"];'!!}
                            @endif

                        </script>
                        <div id="holder"></div>
                    </div>

                    <div class="mapDiv">
                        <div id="canvas"></div>
                    </div>
                    <script src="/js/bstate.js"></script>
                    <script>

                        // var anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                        //     tower_dire_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                        // }).delay(animationTime).repeat(animationRepeat);
                        // tower_dire_top_1.animate(anim);

                        @if (!isset($buildingState) || !is_array($buildingState) || empty($buildingState))

                            @else
                            @foreach ($buildingState as $side => $side_value)
                            @foreach ($side_value as $line => $line_value)
                            @foreach ($line_value as $number => $number_value)
                            @if ($number_value)
                            @if ($number < 3)
                            bstateMap['tower']['{{($side == 'R')?'radiant':'dire'}}']['{{($line == 'top')?'top':(($line == 'mid')?'mid':'bot')}}'][{{$number+1}}] = 1;
                        window['tower_{{($side == 'R')?'radiant_':'dire_'}}{{($line == 'top')?'top_':(($line == 'mid')?'mid_':'bot_')}}{{$number+1}}'].attr({stroke: animateColor, fill:  animateColor});
                        @else
                            bstateMap['building']['{{($side == 'R')?'radiant':'dire'}}']['{{($line == 'top')?'top':(($line == 'mid')?'mid':'bot')}}'][{{$number-2}}] = 1;
                        window['building_{{($side == 'R')?'radiant_':'dire_'}}{{($line == 'top')?'top_':(($line == 'mid')?'mid_':'bot_')}}{{$number-2}}'].attr({stroke: animateColor, fill:  animateColor});
                        @endif
                        @endif
                        @endforeach
                        @endforeach
                        @endforeach
                        @endif

                        // window['tower_dire_top_3'].attr({stroke: animateColor, fill:  animateColor});
                        // tower_dire_top_2.attr({stroke: animateColor, fill:  animateColor});

                    </script>
                </div>
            </div>

            <div class="rightTeam">
                <ul>
                    @if (!isset($realtimeStats) || empty($realtimeStats))

                    @else
                        @for ($i = 0; $i < 10; $i++)

                            @if ($realtimeStats->{$i.'_team'} == 3)
                                <li>
                                    <p><a href="/{{App::getLocale()}}/player/{{(isset($realtimeStats->{$i.'_accountid'}) && $realtimeStats->{$i.'_accountid'})?$realtimeStats->{$i.'_accountid'}:''}}" class="namePl" id="match_display_player_{{$i}}_name_container">{{ $realtimeStats->{$i.'_name'} }}</a></p>
                                    <div class="dopInfo">
                                        <ul class="listG">
                                            <li class="g" id="match_display_player_{{$i}}_kill_container">{{ $realtimeStats->{$i.'_kill_count'} }}</li>
                                            <li class="r" id="match_display_player_{{$i}}_death_container">{{ $realtimeStats->{$i.'_death_count'} }}</li>
                                            <li class="b" id="match_display_player_{{$i}}_assists_container">{{ $realtimeStats->{$i.'_assists_count'} }}</li>
                                        </ul>
                                    </div>
                                    <div class="size57 hero-avatar" id="match_display_player_{{$i}}_avatar_container" {!!(isset($realtimeHeroes[$realtimeStats->{$i.'_accountid'}]) && $realtimeHeroes[$realtimeStats->{$i.'_accountid'}])?'style="background-image: url(/img/heroes/'.$realtimeHeroes[$realtimeStats->{$i.'_accountid'}].'_vertical.png)':''!!}">
                                        <a href="/{{App::getLocale()}}/player/{{(isset($realtimeStats->{$i.'_accountid'}) && $realtimeStats->{$i.'_accountid'})?$realtimeStats->{$i.'_accountid'}:''}}" id="match_display_player_{{$i}}_link_container"></a>
                                    </div>
                                    <span class="ellipse" id="match_display_player_{{$i}}_level_container">{{ $realtimeStats->{$i.'_level'} }}</span>
                                </li>
                            @endif
                        @endfor
                    @endif

                </ul>
            </div>
        </div>
    </div>
    @endif

    @include('layouts.match_display_bottom_banner')

</div>

<script>


function change_live_radiant_score(value)
{
    match_display_radiant_score_container = document.querySelector('#match_display_radiant_score_container');
    match_display_radiant_score_container.innerHTML = value;
}

function change_live_dire_score(value)
{
    match_display_dire_score_container = document.querySelector('#match_display_dire_score_container');
    match_display_dire_score_container.innerHTML = value;
}

function change_live_radiant_lead(value)
{
    if (value > 0)
    {
        match_display_radiant_lead_container = document.querySelector('#match_display_radiant_lead_container');
        match_display_radiant_lead_container.innerHTML = value;
        match_display_dire_lead_container = document.querySelector('#match_display_dire_lead_container');
        match_display_dire_lead_container.innerHTML = '';
    } else if (value < 0)
    {
        match_display_radiant_lead_container = document.querySelector('#match_display_radiant_lead_container');
        match_display_radiant_lead_container.innerHTML = '';
        match_display_dire_lead_container = document.querySelector('#match_display_dire_lead_container');
        match_display_dire_lead_container.innerHTML = value.toString().replace("-", "");
    } else
    {
        match_display_radiant_lead_container = document.querySelector('#match_display_radiant_lead_container');
        match_display_radiant_lead_container.innerHTML = '';
        match_display_dire_lead_container = document.querySelector('#match_display_dire_lead_container');
        match_display_dire_lead_container.innerHTML = '';
    }
}

function change_live_graph_gold(value, data=false)
{
    if (data)
    {
        data = JSON.parse(data);
        for (var i=0;i<data.length;i++)
        {
            graph_data[i] = data[i];
        }
        if (value !== false)
            graph_data[128] = value;
        redrawGraph();
    } else
    {
        // console.log(graph_data);
        graph_data[128] = value;
        redrawGraph();
    }
}

function checkToPlaySound(value, force) {
	let storage = JSON.parse(localStorage.getItem('towers'));

	if (force || storage == null) {
		value['used'] = false;
		if ( value['R']['top'][0] == 1 || value['R']['mid'][0] == 1 || value['R']['bot'][0] == 1 ||
			value['D']['top'][0] == 1 || value['D']['mid'][0] == 1 || value['D']['bot'][0] == 1) {
			value['used'] = true;
        }

		localStorage.setItem('towers', JSON.stringify(value));
    }

	let arrayToCheckTowers = {
		'used': (storage['used'] === true) ? true : false,
		'R': {
			'top': storage['R']['top'][0] == value['R']['top'][0],
			'mid': storage['R']['mid'][0] == value['R']['mid'][0],
			'bot': storage['R']['bot'][0] == value['R']['bot'][0]
		},
		'D': {
			'top': storage['D']['top'][0] == value['D']['top'][0],
			'mid': storage['D']['mid'][0] == value['D']['mid'][0],
			'bot': storage['D']['bot'][0] == value['D']['bot'][0]
		}
    };


	if ( arrayToCheckTowers['used'] === false ) {
		value['used'] = false;
		if (arrayToCheckTowers['R']['top'] === false || arrayToCheckTowers['R']['mid'] === false || arrayToCheckTowers['R']['bot'] === false) {
			makeSound('{{ asset('audio/' .app()->getLocale(). '/tower_rd.mp3') }}');
			value['used'] = true;
		}

		if (arrayToCheckTowers['D']['top'] === false || arrayToCheckTowers['D']['mid'] === false || arrayToCheckTowers['D']['bot'] === false) {
			makeSound('{{ asset('audio/' .app()->getLocale(). '/tower_dr.mp3') }}');
			value['used'] = true;
		}
	}
	else {
        value['used'] = true;
    }

	localStorage.setItem('towers', JSON.stringify(value));


}

function change_live_building_state(value, force=false)
{
	checkToPlaySound(value, force);

    if (parseInt(value['R']['bot'][0]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['bot'][1] = 1;
            tower_radiant_bot_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['bot'][1] == 0)
            {
                bstateMap['tower']['radiant']['bot'][1] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_bot_1.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['bot'][1]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['bot'][2] = 1;
            tower_radiant_bot_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['bot'][2] == 0)
            {
                bstateMap['tower']['radiant']['bot'][2] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_bot_2.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['bot'][2]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['bot'][3] = 1;
            tower_radiant_bot_3.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['bot'][3] == 0)
            {
                bstateMap['tower']['radiant']['bot'][3] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_bot_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_bot_3.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['bot'][3]) == 1)
    {
        if (force)
        {
            bstateMap['building']['radiant']['bot'][1] = 1;
            building_radiant_bot_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['radiant']['bot'][1] == 0)
            {
                bstateMap['building']['radiant']['bot'][1] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    building_radiant_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_radiant_bot_1.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['bot'][4]) == 1)
    {
        if (force)
        {
            bstateMap['building']['radiant']['bot'][2] = 1;
            building_radiant_bot_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['radiant']['bot'][2] == 0)
            {
                bstateMap['building']['radiant']['bot'][2] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    building_radiant_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_radiant_bot_2.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['mid'][0]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['mid'][1] = 1;
            tower_radiant_mid_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['mid'][1] == 0)
            {
                bstateMap['tower']['radiant']['mid'][1] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_mid_1.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['mid'][1]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['mid'][2] = 1;
            tower_radiant_mid_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['mid'][2] == 0)
            {
                bstateMap['tower']['radiant']['mid'][2] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_mid_2.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['mid'][2]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['mid'][3] = 1;
            tower_radiant_mid_3.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['mid'][3] == 0)
            {
                bstateMap['tower']['radiant']['mid'][3] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_mid_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_mid_3.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['mid'][3]) == 1)
    {
        if (force)
        {
            bstateMap['building']['radiant']['mid'][1] = 1;
            building_radiant_mid_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['radiant']['mid'][1] == 0)
            {
                bstateMap['building']['radiant']['mid'][1] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    building_radiant_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_radiant_mid_1.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['mid'][4]) == 1)
    {
        if (force)
        {
            bstateMap['building']['radiant']['mid'][2] = 1;
            building_radiant_mid_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['radiant']['mid'][2] == 0)
            {
                bstateMap['building']['radiant']['mid'][2] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    building_radiant_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_radiant_mid_2.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['top'][0]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['top'][1] = 1;
            tower_radiant_top_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['top'][1] == 0)
            {
                bstateMap['tower']['radiant']['top'][1] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_top_1.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['top'][1]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['top'][2] = 1;
            tower_radiant_top_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['top'][2] == 0)
            {
                bstateMap['tower']['radiant']['top'][2] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_top_2.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['top'][2]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['radiant']['top'][3] = 1;
            tower_radiant_top_3.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['radiant']['top'][3] == 0)
            {
                bstateMap['tower']['radiant']['top'][3] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    tower_radiant_top_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_radiant_top_3.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['top'][3]) == 1)
    {
        if (force)
        {
            bstateMap['building']['radiant']['top'][1] = 1;
            building_radiant_top_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['radiant']['top'][1] == 0)
            {
                bstateMap['building']['radiant']['top'][1] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    building_radiant_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_radiant_top_1.animate(anim);
            }
        }
    }
    if (parseInt(value['R']['top'][4]) == 1)
    {
        if (force)
        {
            bstateMap['building']['radiant']['top'][2] = 1;
            building_radiant_top_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['radiant']['top'][2] == 0)
            {
                bstateMap['building']['radiant']['top'][2] = 1;
                anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                    building_radiant_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_radiant_top_2.animate(anim);
            }
        }
    }



    if (parseInt(value['D']['bot'][0]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['bot'][1] = 1;
            tower_dire_bot_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {

            if (bstateMap['tower']['dire']['bot'][1] == 0)
            {
                bstateMap['tower']['dire']['bot'][1] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_bot_1.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['bot'][1]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['bot'][2] = 1;
            tower_dire_bot_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['bot'][2] == 0)
            {
                bstateMap['tower']['dire']['bot'][2] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_bot_2.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['bot'][2]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['bot'][3] = 1;
            tower_dire_bot_3.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['bot'][3] == 0)
            {
                bstateMap['tower']['dire']['bot'][3] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_bot_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_bot_3.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['bot'][3]) == 1)
    {
        if (force)
        {
            bstateMap['building']['dire']['bot'][1] = 1;
            building_dire_bot_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['dire']['bot'][1] == 0)
            {
                bstateMap['building']['dire']['bot'][1] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    building_dire_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_dire_bot_1.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['bot'][4]) == 1)
    {
        if (force)
        {
            bstateMap['building']['dire']['bot'][2] = 1;
            building_dire_bot_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['dire']['bot'][2] == 0)
            {
                bstateMap['building']['dire']['bot'][2] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    building_dire_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_dire_bot_2.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['mid'][0]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['mid'][1] = 1;
            tower_dire_mid_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['mid'][1] == 0)
            {
                bstateMap['tower']['dire']['mid'][1] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_mid_1.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['mid'][1]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['mid'][2] = 1;
            tower_dire_mid_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['mid'][2] == 0)
            {
                bstateMap['tower']['dire']['mid'][2] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_mid_2.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['mid'][2]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['mid'][3] = 1;
            tower_dire_mid_3.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['mid'][3] == 0)
            {
                bstateMap['tower']['dire']['mid'][3] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_mid_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_mid_3.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['mid'][3]) == 1)
    {
        if (force)
        {
            bstateMap['building']['dire']['mid'][1] = 1;
            building_dire_mid_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['dire']['mid'][1] == 0)
            {
                bstateMap['building']['dire']['mid'][1] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    building_dire_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_dire_mid_1.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['mid'][4]) == 1)
    {
        if (force)
        {
            bstateMap['building']['dire']['mid'][2] = 1;
            building_dire_mid_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['dire']['mid'][2] == 0)
            {
                bstateMap['building']['dire']['mid'][2] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    building_dire_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_dire_mid_2.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['top'][0]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['top'][1] = 1;
            tower_dire_top_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['top'][1] == 0)
            {
                bstateMap['tower']['dire']['top'][1] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_top_1.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['top'][1]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['top'][2] = 1;
            tower_dire_top_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['top'][2] == 0)
            {
                bstateMap['tower']['dire']['top'][2] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_top_2.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['top'][2]) == 1)
    {
        if (force)
        {
            bstateMap['tower']['dire']['top'][3] = 1;
            tower_dire_top_3.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['tower']['dire']['top'][3] == 0)
            {
                bstateMap['tower']['dire']['top'][3] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    tower_dire_top_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                tower_dire_top_3.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['top'][3]) == 1)
    {
        if (force)
        {
            bstateMap['building']['dire']['top'][1] = 1;
            building_dire_top_1.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['dire']['top'][1] == 0)
            {
                bstateMap['building']['dire']['top'][1] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    building_dire_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_dire_top_1.animate(anim);
            }
        }
    }
    if (parseInt(value['D']['top'][4]) == 1)
    {
        if (force)
        {
            bstateMap['building']['dire']['top'][2] = 1;
            building_dire_top_2.attr({stroke: animateColor, fill:  animateColor});
        } else
        {
            if (bstateMap['building']['dire']['top'][2] == 0)
            {
                bstateMap['building']['dire']['top'][2] = 1;
                anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                    building_dire_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                }).delay(animationTime).repeat(animationRepeat);
                building_dire_top_2.animate(anim);
            }
        }
    }
}

function change_live_activate_time(value, zeros=false)
{
    match_display_time_container = document.querySelector('#match_display_time_container');
    if (zeros)
    {
        match_display_time_container.innerHTML = '0:00';
    } else
    {
        var match_display_activate_time = new Date(Date.now() - (value * 1000));
        var match_display_activate_time_seconds = match_display_activate_time.getUTCSeconds();
        if (match_display_activate_time_seconds < 10)
            match_display_activate_time_seconds = "0"+match_display_activate_time_seconds;
        match_display_time_container.innerHTML = match_display_activate_time.getUTCMinutes()+':'+match_display_activate_time_seconds;
    }
}

function change_live_player_avatar(value,player_id,account_id=0)
{
    window['match_display_player_'+parseInt(player_id)+'_avatar_container'] = document.querySelector('#match_display_player_'+parseInt(player_id)+'_avatar_container');
    window['match_display_player_'+parseInt(player_id)+'_avatar_container'].setAttribute("style", parseInt(value) > 0 ? "background-image: url(/img/heroes/"+value+"_vertical.png)" : "");
    if (account_id)
    {
        window['match_display_player_'+parseInt(player_id)+'_name_container'].setAttribute("href", "/{{App::getLocale()}}/player/"+account_id);
        window['match_display_player_'+parseInt(player_id)+'_link_container'].setAttribute("href", "/{{App::getLocale()}}/player/"+account_id);
    }
}

function change_live_player_level(value,player_id)
{
    window['match_display_player_'+parseInt(player_id)+'_level_container'] = document.querySelector('#match_display_player_'+parseInt(player_id)+'_level_container');
    window['match_display_player_'+parseInt(player_id)+'_level_container'].innerHTML = value;
}

function change_live_player_kill(value,player_id)
{
    window['match_display_player_'+parseInt(player_id)+'_kill_container'] = document.querySelector('#match_display_player_'+parseInt(player_id)+'_kill_container');
    window['match_display_player_'+parseInt(player_id)+'_kill_container'].innerHTML = value;
}

function change_live_player_death(value,player_id)
{
    window['match_display_player_'+parseInt(player_id)+'_death_container'] = document.querySelector('#match_display_player_'+parseInt(player_id)+'_death_container');
    window['match_display_player_'+parseInt(player_id)+'_death_container'].innerHTML = value;
}

function change_live_player_assists(value,player_id)
{
    window['match_display_player_'+parseInt(player_id)+'_assists_container'] = document.querySelector('#match_display_player_'+parseInt(player_id)+'_assists_container');
    window['match_display_player_'+parseInt(player_id)+'_assists_container'].innerHTML = value;
}

// function change_live_player_gold(value,player_id)
// {
//     window['match_display_player_'+parseInt(player_id)+'_gold_container'] = document.querySelector('#match_display_player_'+parseInt(player_id)+'_gold_container');
//     window['match_display_player_'+parseInt(player_id)+'_gold_container'].innerHTML = value;
// }

function change_live_player_name(value,player_id)
{
    window['match_display_player_'+parseInt(player_id)+'_name_container'] = document.querySelector('#match_display_player_'+parseInt(player_id)+'_name_container');
    window['match_display_player_'+parseInt(player_id)+'_name_container'].innerHTML = value;
}

function change_live_radiant_team_logo(value)
{
    match_display_radiant_team_logo_container = document.querySelector('#match_display_radiant_team_logo_container');
    match_display_radiant_team_logo_container.setAttribute("src", "/img/team/"+value+".png");
}

function change_live_dire_team_logo(value)
{
    match_display_dire_team_logo_container = document.querySelector('#match_display_dire_team_logo_container');
    match_display_dire_team_logo_container.setAttribute("src", "/img/team/"+value+".png");
}

function change_stream_id(value)
{
    if (value)
    {
        twitch_embed_container = document.querySelector('#twitch-embed');
        twitch_embed_container.innerHTML = '';
        new Twitch.Embed("twitch-embed", {
            channel: value,
            layout: "video",
            width: "100%",
            height: "100%",
            autoPlay: true,
            muted: true,
            setVolume: 0.5
        });

    } else
    {
        twitch_embed_container = document.querySelector('#twitch-embed');
        twitch_embed_container.innerHTML = '<div class="no_stream_banner"></div>';
    }
}


live_channel = function(data){
        // console.log(data);
        if (typeof data !== 'undefined' && typeof data['data'] !== 'undefined')
        {
            if (typeof data['data']['match_display_radiant_score'] !== 'undefined')
            {
                change_live_radiant_score(data['data']['match_display_radiant_score']);
            }
            if (typeof data['data']['match_display_dire_score'] !== 'undefined')
            {
                change_live_dire_score(data['data']['match_display_dire_score']);
            }
            if (typeof data['data']['match_display_radiant_lead'] !== 'undefined')
            {
                change_live_radiant_lead(data['data']['match_display_radiant_lead']);
                if (typeof data['data']['match_display_graph_data'] === 'undefined')
                {
                    change_live_graph_gold(data['data']['match_display_radiant_lead']);
                }
            }
            if (typeof data['data']['match_display_building_state'] !== 'undefined')
            {
                change_live_building_state(data['data']['match_display_building_state']);
            }
            if (typeof data['data']['match_display_graph_data'] !== 'undefined')
            {
                if (typeof data['data']['match_display_radiant_lead'] !== 'undefined')
                {
                    change_live_graph_gold(data['data']['match_display_radiant_lead'], data['data']['match_display_graph_data']);
                } else
                {
                    change_live_graph_gold(false, data['data']['match_display_graph_data']);
                }
            }
            if (typeof data['data']['match_display_activate_time'] !== 'undefined')
            {
                if (data['data']['match_display_activate_time']=="0")
                {
                    change_live_activate_time(0, true);
                } else
                {
                    change_live_activate_time(data['data']['match_display_activate_time']);
                }
            }

            for (i = 0; i < 10; i++)
            {
                if (typeof data['data']['match_display_player_'+parseInt(i)+'_avatar'] !== 'undefined')
                {
                    change_live_player_avatar(data['data']['match_display_player_'+parseInt(i)+'_avatar'], parseInt(i));
                }
                if (typeof data['data']['match_display_player_'+parseInt(i)+'_level'] !== 'undefined')
                {
                    change_live_player_level(data['data']['match_display_player_'+parseInt(i)+'_level'], parseInt(i));
                }
                if (typeof data['data']['match_display_player_'+parseInt(i)+'_kill'] !== 'undefined')
                {
                    change_live_player_kill(data['data']['match_display_player_'+parseInt(i)+'_kill'], parseInt(i));
                }
                if (typeof data['data']['match_display_player_'+parseInt(i)+'_death'] !== 'undefined')
                {
                    change_live_player_death(data['data']['match_display_player_'+parseInt(i)+'_death'], parseInt(i));
                }
                if (typeof data['data']['match_display_player_'+parseInt(i)+'_assists'] !== 'undefined')
                {
                    change_live_player_assists(data['data']['match_display_player_'+parseInt(i)+'_assists'], parseInt(i));
                }
                // if (typeof data['data']['match_display_player_'+parseInt(i)+'_gold'] !== 'undefined')
                // {
                //     change_live_player_gold(data['data']['match_display_player_'+parseInt(i)+'_gold'], parseInt(i));
                // }
            }

            if (typeof data['data']['change_channel'] !== 'undefined')
            {
                change_channel(parseInt(data['data']['change_channel']), data);
            }

        }

    }

    function change_channel(channel, data=false, $force=false)
    {
        socket.off('live_'+window.current_channel);
        if (channel == 'stop')
            return true;

        if ($force)
            building_state_renew();

        window.current_channel = channel;

        socket.on('live_'+window.current_channel, live_channel);

        if (typeof data['data']['radiant_lead'] !== 'undefined')
        {
            change_live_radiant_lead(data['data']['radiant_lead']);
        }

        if (typeof data['data']['radiant_score'] !== 'undefined')
        {
            change_live_radiant_score(data['data']['radiant_score']);
        }

        if (typeof data['data']['dire_score'] !== 'undefined')
        {
            change_live_dire_score(data['data']['dire_score']);
        }

        if (typeof data['data']['building_state'] !== 'undefined')
        {
            change_live_building_state(data['data']['building_state'], true);
        }

        if (typeof data['data']['map_start'] !== 'undefined')
        {
            if (data['data']['MStatus']==21)
            {
                change_live_activate_time(0, true);
            } else
            {
                change_live_activate_time(data['data']['map_start']);
            }
        }

        if (typeof data['data']['team_id_radiant'] !== 'undefined')
        {
            change_live_radiant_team_logo(data['data']['team_id_radiant']);
        }

        if (typeof data['data']['team_id_dire'] !== 'undefined')
        {
            change_live_dire_team_logo(data['data']['team_id_dire']);
        }

        if (typeof data['data']['graph_data'] !== 'undefined')
        {
            change_live_graph_gold(data['data']['radiant_lead'], data['data']['graph_data']);
        }

        for (i = 0; i < 10; i++)
        {
            if (typeof data['data'][parseInt(i)+'_avatar'] !== 'undefined')
            {
                change_live_player_avatar(data['data'][parseInt(i)+'_avatar'], parseInt(i), data['data'][parseInt(i)+'_accountid']);
            }
            if (typeof data['data'][parseInt(i)+'_level'] !== 'undefined')
            {
                change_live_player_level(data['data'][parseInt(i)+'_level'], parseInt(i));
            }
            if (typeof data['data'][parseInt(i)+'_kill_count'] !== 'undefined')
            {
                change_live_player_kill(data['data'][parseInt(i)+'_kill_count'], parseInt(i));
            }
            if (typeof data['data'][parseInt(i)+'_death_count'] !== 'undefined')
            {
                change_live_player_death(data['data'][parseInt(i)+'_death_count'], parseInt(i));
            }
            if (typeof data['data'][parseInt(i)+'_assists_count'] !== 'undefined')
            {
                change_live_player_assists(data['data'][parseInt(i)+'_assists_count'], parseInt(i));
            }
            // if (typeof data['data'][parseInt(i)+'_gold'] !== 'undefined')
            // {
            //     change_live_player_gold(data['data'][parseInt(i)+'_gold'], parseInt(i));
            // }
            if (typeof data['data'][parseInt(i)+'_name'] !== 'undefined')
            {
                change_live_player_name(data['data'][parseInt(i)+'_name'], parseInt(i));
            }
            if (typeof data['data']['stream_channel'] !== 'undefined')
            {
                change_stream_id(data['data']['stream_channel']);
            }
        }
    }

    function force_change_channel(value)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                change_channel(value, JSON.parse(this.responseText), true);
            }
        };
        xhttp.open("GET", "channel/"+value, false);
        xhttp.send();
    }

    current_channel = 0;
    socket.on('live_'+current_channel, live_channel);

    localStorage.removeItem('towers');
    localStorage.removeItem('live_data');

</script>
