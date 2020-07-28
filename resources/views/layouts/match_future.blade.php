<div id="match_future_container" style="display: none;">
@if (!isset($dataFuture) || !is_array($dataFuture) || empty($dataFuture))

@else
    @foreach ($dataFuture as $futureMatch)
        <li class="future">
            <div class="match-item">
                <div class="leftTeam ">
                    <span class="nameTeam">{{ $futureMatch->team_0_name }}</span>
                    <div class="imgTeam">
                        <img src="{{ ($futureMatch->team_0) ? '/img/team/'.$futureMatch->team_0.'.png' : '' }}" alt="">
                    </div>
                </div>
                <div class="centerTime">
                    <span class="infoTeam">
                        <span class="time">{{date('H', $futureMatch->start_datetime).':'.date('i', $futureMatch->start_datetime)}}</span>
                        <span class="day">{{date('d', $futureMatch->start_datetime).'.'.date('m', $futureMatch->start_datetime)}}</span>
                    </span>
                    <span class="ligaTeam"><a href=""><img src="{{ ($futureMatch->league_id) ? '/img/league/'.$futureMatch->league_id.'.png' : '' }}" alt="{{ $futureMatch->league_id }}"></a></span>
                </div>
                <div class="rightTeam ">
                    <span class="nameTeam">{{ $futureMatch->team_1_name }}</span>
                    <div class="imgTeam">
                        <img src="{{ ($futureMatch->team_1) ? '/img/team/'.$futureMatch->team_1.'.png' : '' }}" alt="">
                    </div>
                </div>
            </div>
        </li>
    @endforeach
@endif
</div>
<script>
    socket.on('matches_future', function(data){
        // console.log(data);
        match_future_container = document.querySelector('#match_future_container');
        match_future_container.innerHTML = "";
        if (typeof data !== 'undefined' && typeof data['data'] !== 'undefined')
        {
            len = data['data'].length;
            if (typeof len !== 'undefined' || len > 0)
            {
                keys = Object.keys(data['data'])
                for (i = 0; i < len; i++) {
                    li = document.createElement("li");
                    match_future_container.appendChild(li);
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
                    span000 = document.createElement("span");
                    div00.appendChild(span000);
                    span000.setAttribute("class", "nameTeam");
                    span000.innerHTML = data['data'][i]['team_0_name'];
                    div000 = document.createElement("div");
                    div00.appendChild(div000);
                    div000.setAttribute("class", "imgTeam");
                    img0000 = document.createElement("img");
                    div000.appendChild(img0000);
                    if (data['data'][i]['team_0'])
                        img0000.setAttribute("src", "/img/team/"+data['data'][i]['team_0']+".png");
                    span020 = document.createElement("span");
                    div02.appendChild(span020);
                    span020.setAttribute("class", "nameTeam");
                    span020.innerHTML = data['data'][i]['team_1_name'];
                    div020 = document.createElement("div");
                    div02.appendChild(div020);
                    div020.setAttribute("class", "imgTeam");
                    img0200 = document.createElement("img");
                    div020.appendChild(img0200);
                    if (data['data'][i]['team_1'])
                        img0200.setAttribute("src", "/img/team/"+data['data'][i]['team_1']+".png");
                    span010 = document.createElement("span");
                    div01.appendChild(span010);
                    span010.setAttribute("class", "infoTeam");
                    // span010.innerHTML = data['data'][i]['team_0_score']+":"+data['data'][i]['team_1_score'];
                    span0100 = document.createElement("span");
                    span010.appendChild(span0100);
                    span0100.setAttribute("class", "time");
                    var future_date = new Date(data['data'][i]['start_datetime'] * 1000);
                    var minutes = future_date.getUTCMinutes();
                    if (minutes < 10)
                        minutes = "0"+minutes;
                    span0100.innerHTML = future_date.getUTCHours()+':'+minutes;
                    span0101 = document.createElement("span");
                    span010.appendChild(span0101);
                    span0101.setAttribute("class", "day");
                    var date = future_date.getUTCDate();
                    if (date < 10)
                        date = "0"+date;
                    var month = future_date.getUTCMonth();
                    month = month+1;
                    if (month < 10)
                        month = "0"+month;
                    span0101.innerHTML = date+'.'+month;
                    span011 = document.createElement("span");
                    div01.appendChild(span011);
                    span011.setAttribute("class", "ligaTeam");
                    a0110 = document.createElement("a");
                    span011.appendChild(a0110);
                    img01100 = document.createElement("img");
                    a0110.appendChild(img01100);
                    img01100.setAttribute("src", "/img/league/"+data['data'][i]['league_id']+".png");

                }

            }

        }
    })
</script>