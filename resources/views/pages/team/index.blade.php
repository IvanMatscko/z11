@extends('layouts.blank')

@section('header')
    <script>
        var socket = io.connect('http://z11:3000');
    </script>
    @include('layouts.header')
@endsection

@section('content')
<div class="content">
    <div class="side-container pl-container">

        <div class="l-players">
            @for($i=0; $i<6; $i++)
                @php
                $team = $teams->slice($i, 1)->first();
                @endphp
                @if($team)
                    @if($i == 2)
                        @if ( isset( $page ) && $page > 1 )
                            <div class="div-players arrow">
                                <a href="/{{ App::getLocale() }}/teams?page={{ round($page, 0)-1 }}"><img class="arr-dark" src="/img/pl-arrow.png" alt=""> <img  src="/img/pl-arrow-b.png" alt=""></a>
                            </div>
                        @endif
                    @endif
                    <div class="div-players">
                        <p class="tm-winrate">Winrate: <span>{{ $team->winrate }}</span>%</p>
                        <div class="pl-div">
                            <a href="/{{App::getLocale()}}/team/{{$team->team_id}}">
                                <div class="img-wrap img-team">
                                    <img src="{{ file_exists(public_path()."/img/team/{$team->team_id}.png") ? asset("/img/team/{$team->team_id}.png") : asset('/img/team/dota-none-dark.png') }}" alt="">
                                </div>
                                <object>
                                    <ul class="tm-players">
                                        @for($p=0; $p<5; $p++)
                                            @php
                                                $player = $team->players->slice($p, 1)->first();
                                            @endphp
                                            @switch($p)
                                                @case(0)
                                                <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                                @break
                                                @case(1)
                                                <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                                @break
                                                @case(2)
                                                <li class="h2"><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                                @break
                                                @case(3)
                                                <li class="h2r"><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                                @break
                                                @case(4)
                                                <li class="countr"> <img src="{{ asset("/img/flag/" . Str::upper($team->country_code) . ".png") }}" alt="{{ $team->team_name ?? '' }}"></li>
                                                <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                                @break
                                                @case(5)
                                                <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                                @break
                                            @endswitch
                                        @endfor
                                    </ul>
                                </object>
                            </a>
                        </div>
                        <p class="tm-name">{{ $team->team_name }}</p>
                    </div>
                @endif
            @endfor
        </div>



        <div class="c-players">
            @for($i=6; $i<12; $i++)
                @php
                    $team = $teams->slice($i, 1)->first();
                @endphp
                @if($team)
                    @if($i-6 == 2)
                        <div class="div-players search">
                            <form action="{{'/'.App::getLocale()}}/search" method="post">
                                <div class="input-div">
                                    <input class="input" list="search_list-team_page" type="text" id="search_z11-team_page" name="search_z11" placeholder="{{ __('l.search_placeholder') }}">
                                    <input class="btn" type="submit" value="">
                                </div>
                                <template id="resultstemplate-team_page">
                                    @foreach ($search_block as $search_value)
                                        <option>{{$search_value}}</option>
                                    @endforeach
                                </template>
                                <datalist id="search_list-team_page" class="search_list-team_page">
                                </datalist>
                            </form>
                        </div>
                        <script>
                            var search_team_page = document.querySelector('#search_z11-team_page');
                            var results_team_page = document.querySelector('#search_list-team_page');
                            var templateContent_team_page = document.querySelector('#resultstemplate-team_page').content;
                            search_team_page.addEventListener('keyup', function handler(event) {
                                while (results_team_page.children.length) results_team_page.removeChild(results_team_page.firstChild);
                                var inputVal = new RegExp(search_team_page.value.trim(), 'i');
                                var set = Array.prototype.reduce.call(templateContent_team_page.cloneNode(true).children, function searchFilter(frag, item, i) {
                                    if (inputVal.test(item.textContent) && frag.children.length < 5) frag.appendChild(item);
                                    return frag;
                                }, document.createDocumentFragment());
                                results_team_page.appendChild(set);
                            });
                        </script>
                    @endif
                    <div class="div-players">
                        <p class="tm-winrate">Winrate: <span>{{ $team->winrate }}</span>%</p>
                        <div class="pl-div">
                            <a href="/{{App::getLocale()}}/team/{{$team->team_id}}">
                                <div class="img-wrap img-team">
                                    <img src="{{ file_exists(public_path()."/img/team/{$team->team_id}.png") ? asset("/img/team/{$team->team_id}.png") : asset('/img/team/dota-none-dark.png') }}" alt="">
                                </div>
                                <object>
                                    <ul class="tm-players">
                                    @for($p=0; $p<5; $p++)
                                        @php
                                            $player = $team->players->slice($p, 1)->first();
                                        @endphp
                                        @switch($p)
                                            @case(0)
                                            <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(1)
                                                <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(2)
                                                <li class="h2"><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(3)
                                                <li class="h2r"><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(4)
                                            <li class="countr"> <img src="{{ file_exists(public_path()."/img/flag/" . Str::upper($team->country_code) . ".png") ? asset("/img/flag/" . Str::upper($team->country_code) . ".png") : asset('/img/players/default-dark.png') }}" alt="{{ $team->team_name ?? '' }}"></li>
                                            <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(5)
                                                <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                        @endswitch
                                    @endfor
                                </ul>
                                </object>
                            </a>
                        </div>
                        <p class="tm-name">{{ $team->team_name }}</p>
                    </div>
                @endif
            @endfor
        </div>


        <div class="r-players">
            @for($i=12; $i<18; $i++)
                @php
                    $team = $teams->slice($i, 1)->first();
                @endphp
                @if($team)
                    @if($i-12 == 2)
                        @if ( $teams->count() == 18 )
                            <div class="div-players arrow right">
                                <a href="/{{ App::getLocale() }}/teams?page={{ $page ? round($page, 0)+1 : 2 }}"><img class="arr-dark" src="/img/pl-arrow.png" alt=""> <img  src="/img/pl-arrow-b.png" alt=""></a>
                            </div>
                        @endif
                    @endif
                    <div class="div-players">
                        <p class="tm-winrate">Winrate: <span>{{ $team->winrate }}</span>%</p>
                        <div class="pl-div">
                            <a href="/{{App::getLocale()}}/team/{{$team->team_id}}">
                                <div class="img-wrap img-team">
                                    <img src="{{ file_exists(public_path()."/img/team/{$team->team_id}.png") ? asset("/img/team/{$team->team_id}.png") : asset('/img/team/dota-none-dark.png') }}" alt="">
                                </div>
                                <object>
                                    <ul class="tm-players">
                                    @for($p=0; $p<5; $p++)
                                        @php
                                            $player = $team->players->slice($p, 1)->first();
                                        @endphp
                                        @switch($p)
                                            @case(0)
                                            <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(1)
                                            <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(2)
                                            <li class="h2"><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(3)
                                            <li class="h2r"><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(4)
                                            <li class="countr"> <img src="{{ file_exists(public_path()."/img/flag/" . Str::upper($team->country_code) . ".png") ? asset("/img/flag/" . Str::upper($team->country_code) . ".png") : asset('/img/players/default-dark.png') }}" alt="{{ $team->team_name ?? '' }}"></li>
                                            <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                            @case(5)
                                            <li><a href="/{{App::getLocale()}}/player/{{ isset($player) ? $player->account_id : '' }}"><img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="{{ @$player->account_id }}"></a></li>
                                            @break
                                        @endswitch
                                    @endfor
                                </ul>
                                </object>
                            </a>
                        </div>
                        <p class="tm-name">{{ $team->team_name }}</p>
                    </div>
                @endif
            @endfor
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
