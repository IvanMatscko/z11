<ul class="match-list-info" id="match_past_container">
    @if (!isset($dataPast) || !is_array($dataPast) || empty($dataPast))

    @else

        @foreach ($dataPast as $pastMatch)

            <li class="last open">
                <ul class="postMenu">
                    @php
                        $mapWin = $pastMatch->dire_win_maps !== '' && !is_null($pastMatch->dire_win_maps) ? explode(',',$pastMatch->dire_win_maps) : false;
                    @endphp
                    @if (!is_array($mapWin) || empty($mapWin))

                    @else
                        @foreach ($mapWin as $mapWinNumber)
                            <li class="red"><a id="{{$pastMatch->series_id}}" class="postLink map_number" href="#" >map {{$mapWinNumber}}</a></li>
                        @endforeach

                    @endif

                    @php
                        $mapWin = $pastMatch->radiant_win_maps !== '' && !is_null($pastMatch->radiant_win_maps) ? explode(',',$pastMatch->radiant_win_maps) : false;
                    @endphp
                    @if (!is_array($mapWin) || empty($mapWin))

                    @else
                        @foreach ($mapWin as $mapWinNumber)
                            <li class="red"><a id="{{$pastMatch->series_id}}" class="postLink map_number" href="#" >map {{$mapWinNumber}}</a></li>
                        @endforeach
                    @endif

                </ul>
                <div class="match-item">
                    <div class="leftTeam {{ ($pastMatch->radiant_win_in_series > $pastMatch->dire_win_in_series) ? 'win' : '' }}">
                        <span class="nameTeam">{{ $pastMatch->lm_team_0_name }}</span>
                        <div class="imgTeam">
                            <img src="{{ ($pastMatch->lm_team_0) ? '/img/team/'.$pastMatch->lm_team_0.'.png' : '' }}" alt="">
                        </div>
@php
$mapWin = $pastMatch->radiant_win_maps !== '' && !is_null($pastMatch->radiant_win_maps) ? explode(',',$pastMatch->radiant_win_maps) : false;
@endphp
                        @if (!is_array($mapWin) || empty($mapWin))

                        @else
                            <ul class="shields">
                            @foreach ($mapWin as $mapWinNumber)
                                <li class="red">{{$mapWinNumber}}</li>
                            @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="centerTime">
                        <span class="countTeam">{{ $pastMatch->radiant_win_in_series }} - {{ $pastMatch->dire_win_in_series }}</span>
                        <span class="ligaTeam"><img src="{{ ($pastMatch->league_id) ? '/img/league/'.$pastMatch->league_id.'.png' : '' }}" alt="{{ $pastMatch->league_id }}"></span>
                    </div>
                    <div class="rightTeam {{ ($pastMatch->dire_win_in_series > $pastMatch->radiant_win_in_series) ? 'win' : '' }}">
                        <span class="nameTeam">{{ $pastMatch->lm_team_1_name }}</span>
                        <div class="imgTeam">
                            <img src="{{ ($pastMatch->lm_team_1) ? '/img/team/'.$pastMatch->lm_team_1.'.png' : '' }}" alt="">
                        </div>
@php
$mapWin = $pastMatch->dire_win_maps !== '' && !is_null($pastMatch->dire_win_maps) ? explode(',',$pastMatch->dire_win_maps) : false;
@endphp
                        @if (!is_array($mapWin) || empty($mapWin))

                        @else
                            <ul class="shields">
                            @foreach ($mapWin as $mapWinNumber)
                                <li class="red">{{$mapWinNumber}}</li>
                            @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    @endif

</ul>
<script>


    socket.on('matches_past', function(data){
        // console.log(data);
        match_past_container = document.querySelector('#match_past_container');
        match_past_container.innerHTML = "";
        if (typeof data !== 'undefined' && typeof data['data'] !== 'undefined')
        {
            len = data['data'].length;
            if (typeof len !== 'undefined' || len > 0)
            {
                keys = Object.keys(data['data'])
                for (i = 0; i < len; i++) {
                    li = document.createElement("li");
                    match_past_container.appendChild(li);
                    li.setAttribute("class", "last open");
                    div0 = document.createElement("div");
                    li.appendChild(div0);
                    div0.setAttribute("class", "match-item");
                    div0.setAttribute("onclick", "$('.match-list-info li').removeClass('focus');$(this).parent().addClass('focus');");
                    div00 = document.createElement("div");
                    div0.appendChild(div00);
                    div00.setAttribute("class", "leftTeam");
                    div01 = document.createElement("div");
                    div0.appendChild(div01);
                    div01.setAttribute("class", "centerTime");
                    div02 = document.createElement("div");
                    div0.appendChild(div02);
                    div02.setAttribute("class", "rightTeam");
                    if (data['data'][i]['radiant_win_in_series'] != data['data'][i]['dire_win_in_series'])
                    {
                        if (data['data'][i]['lm_winner'] == "1")
                            div00.setAttribute("class", div00.getAttribute("class")+" win");
                        else
                            div02.setAttribute("class", div02.getAttribute("class")+" win");
                    }
                    span000 = document.createElement("span");
                    div00.appendChild(span000);
                    span000.setAttribute("class", "nameTeam");
                    span000.innerHTML = data['data'][i]['lm_team_0_name'];
                    div000 = document.createElement("div");
                    div00.appendChild(div000);
                    div000.setAttribute("class", "imgTeam");
                    img0000 = document.createElement("img");
                    div000.appendChild(img0000);
                    mapWin = data['data'][i]['radiant_win_maps'] !== '' && data['data'][i]['radiant_win_maps'] !== null ? data['data'][i]['radiant_win_maps'].split(',') : false;
                    if (mapWin !== false && mapWin.length > 0)
                    {
                        ul000 = document.createElement("ul");
                        div00.appendChild(ul000);
                        ul000.setAttribute("class", "shields");
                        for (mi=0;mi<mapWin.length;mi++)
                        {
                            li0000 = document.createElement("li");
                            ul000.appendChild(li0000);
                            li0000.setAttribute("class", "red");
                            li0000.innerHTML = mapWin[mi];
                        }
                    }
                    if (data['data'][i]['lm_team_0'])
                        img0000.setAttribute("src", "/img/team/"+data['data'][i]['lm_team_0']+".png");
                    span020 = document.createElement("span");
                    div02.appendChild(span020);
                    span020.setAttribute("class", "nameTeam");
                    span020.innerHTML = data['data'][i]['lm_team_1_name'];
                    div020 = document.createElement("div");
                    div02.appendChild(div020);
                    div020.setAttribute("class", "imgTeam");
                    img0200 = document.createElement("img");
                    div020.appendChild(img0200);
                    mapWin = data['data'][i]['dire_win_maps'] !== '' && data['data'][i]['dire_win_maps'] !== null ? data['data'][i]['dire_win_maps'].split(',') : false;
                    if (mapWin !== false && mapWin.length > 0)
                    {
                        ul020 = document.createElement("ul");
                        div02.appendChild(ul020);
                        ul020.setAttribute("class", "shields");
                        for (mi=0;mi<mapWin.length;mi++)
                        {
                            li0200 = document.createElement("li");
                            ul020.appendChild(li0200);
                            li0200.setAttribute("class", "red");
                            li0200.innerHTML = mapWin[mi];
                        }
                    }
                    if (data['data'][i]['lm_team_1'])
                        img0200.setAttribute("src", "/img/team/"+data['data'][i]['lm_team_1']+".png");
                    span010 = document.createElement("span");
                    div01.appendChild(span010);
                    span010.setAttribute("class", "countTeam");
                    span010.innerHTML = data['data'][i]['radiant_win_in_series']+" - "+data['data'][i]['dire_win_in_series'];
                    span011 = document.createElement("span");
                    div01.appendChild(span011);
                    span011.setAttribute("class", "ligaTeam");
                    img01100 = document.createElement("img");
                    span011.appendChild(img01100);
                    img01100.setAttribute("src", "/img/league/"+data['data'][i]['league_id']+".png");

                }

            }

        }
    })
</script>
