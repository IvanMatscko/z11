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
                    $player = $players->slice($i, 1)->first();
                @endphp
                @if($player)
                    @if($i == 2)
                        @if (!$players->onFirstPage())
                            <div class="div-players arrow">
                                <a href="{{ $players->previousPageUrl() }}"><img class="arr-dark" src="/img/pl-arrow.png" alt=""> <img  src="/img/pl-arrow-b.png" alt=""></a>
                            </div>
                        @endif
                    @endif
                    <div class="div-players">
                        <p class="pl-name">{{ $player->name }}</p>
                        <div class="pl-div">
                            <a href="/{{App::getLocale()}}/player/{{ $player->account_id ?? '' }}">
                                <div class="img-wrap">
                                    <img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="">
                                </div>
                                <div class="pl-num">{{ $player->position }}</div>
                                <div class="pl-country"><img src="{{ file_exists(public_path()."/img/flag/" . Str::upper($player->team->country_code) . ".png") ? asset("/img/flag/" . Str::upper($player->team->country_code) . ".png") : asset('/img/players/default-dark.png') }}" alt=""></div>
                                <ul class="pl-heroes">
                                    @for($h=0; $h<3; $h++)
                                        @php
                                            $heroes = array_keys($player->heroes);
                                        @endphp
                                        @isset($heroes[$h])
                                            <li {{ $h == 1 ? 'class="h2"' : '' }}><img src="{{ file_exists(public_path('/img/heroes/'.$heroes[$h].'_vertical.png')) ? asset('/img/heroes/'.$heroes[$h].'_vertical.png') : asset('/img/players/default-dark.png') }}" alt=""></li>
                                        @endisset
                                    @endfor
                                </ul>
                            </a>
                        </div>
                        <div class="tm-logo">
                            <object><a href="/{{App::getLocale()}}/team/{{$player->team->team_id}}"><img src="{{ file_exists(public_path()."/img/team/{$player->team->team_id}.png") ? asset("/img/team/{$player->team->team_id}.png") : asset('/img/team/dota-none-dark.png') }}" alt=""></a></object>
                        </div>
                    </div>
                @endif
            @endfor
        </div>


        <div class="c-players">
            @for($i=6; $i<12; $i++)
                @php
                    $player = $players->slice($i, 1)->first();
                @endphp
                @if($player)
                    @if($i-6 == 2)
                        <div class="div-players search">
                            <form action="{{'/'.App::getLocale()}}/search" method="post">
                                <div class="input-div">
                                    <input class="input" list="search_list-player_page" type="text" id="search_z11-player_page" name="search_z11" placeholder="{{ __('l.search_placeholder') }}">
                                    <input class="btn" type="submit" value="">
                                </div>
                                <template id="resultstemplate-player_page">
                                    @foreach ($search_block as $search_value)
                                        <option>{{$search_value}}</option>
                                    @endforeach
                                </template>
                                <datalist id="search_list-player_page" class="search_list-player_page">
                                </datalist>
                            </form>
                        </div>
                        <script>
                            var search_player_page = document.querySelector('#search_z11-player_page');
                            var results_player_page = document.querySelector('#search_list-player_page');
                            var templateContent_player_page = document.querySelector('#resultstemplate-player_page').content;
                            search_player_page.addEventListener('keyup', function handler(event) {
                                while (results_player_page.children.length) results_player_page.removeChild(results_player_page.firstChild);
                                var inputVal = new RegExp(search_player_page.value.trim(), 'i');
                                var set = Array.prototype.reduce.call(templateContent_player_page.cloneNode(true).children, function searchFilter(frag, item, i) {
                                    if (inputVal.test(item.textContent) && frag.children.length < 5) frag.appendChild(item);
                                    return frag;
                                }, document.createDocumentFragment());
                                results_player_page.appendChild(set);
                            });
                        </script>
                    @endif
                    <div class="div-players">
                        <p class="pl-name">{{ $player->name }}</p>
                        <div class="pl-div">
                            <a href="/{{App::getLocale()}}/player/{{ $player->account_id ?? '' }}">
                                <div class="img-wrap">
                                    <img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="">
                                </div>
                                <div class="pl-num">{{ $player->position }}</div>
                                <div class="pl-country"><img src="{{ file_exists(public_path()."/img/flag/" . Str::upper($player->team->country_code) . ".png") ? asset("/img/flag/" . Str::upper($player->team->country_code) . ".png") : asset('/img/players/default-dark.png') }}" alt=""></div>
                                <ul class="pl-heroes">
                                    @for($h=0; $h<3; $h++)
                                        @php
                                            $heroes = array_keys($player->heroes);
                                        @endphp
                                        @isset($heroes[$h])
                                            <li {{ $h == 1 ? 'class="h2"' : '' }}><img src="{{ file_exists(public_path('/img/heroes/'.$heroes[$h].'_vertical.png')) ? asset('/img/heroes/'.$heroes[$h].'_vertical.png') : asset('/img/players/default-dark.png') }}" alt=""></li>
                                        @endisset
                                    @endfor
                                </ul>
                            </a>
                        </div>
                        <div class="tm-logo">
                            <object><a href="/{{App::getLocale()}}/team/{{$player->team->team_id}}"><img src="{{ file_exists(public_path()."/img/team/{$player->team->team_id}.png") ? asset("/img/team/{$player->team->team_id}.png") : asset('/img/team/dota-none-dark.png') }}" alt=""></a></object>
                        </div>
                    </div>
                @endif
            @endfor
        </div>


        <div class="r-players">
            @for($i=12; $i<18; $i++)
                @php
                    $player = $players->slice($i, 1)->first();
                @endphp
                @if($player)
                    @if($i-12 == 2)
                        @if ($players->hasMorePages())
                            <div class="div-players arrow right">
                                <a href="{{ $players->nextPageUrl() }}"><img class="arr-dark" src="/img/pl-arrow.png" alt=""> <img  src="/img/pl-arrow-b.png" alt=""></a>
                            </div>
                        @endif
                    @endif
                    <div class="div-players">
                        <p class="pl-name">{{ $player->name }}</p>
                        <div class="pl-div">
                            <a href="/{{App::getLocale()}}/player/{{ $player->account_id ?? '' }}">
                                <div class="img-wrap">
                                    <img src="{{ file_exists(public_path()."/img/players/" .@$player->account_id. ".png") ? asset("/img/players/" .$player->account_id. ".png") : asset('/img/players/default-dark.png') }}" alt="">
                                </div>
                                <div class="pl-num">{{ $player->position }}</div>
                                <div class="pl-country"><img src="{{ file_exists(public_path()."/img/flag/" . Str::upper($player->team->country_code) . ".png") ? asset("/img/flag/" . Str::upper($player->team->country_code) . ".png") : asset('/img/players/default-dark.png') }}" alt=""></div>
                                <ul class="pl-heroes">
                                    @for($h=0; $h<3; $h++)
                                        @php
                                            $heroes = array_keys($player->heroes);
                                        @endphp
                                        @isset($heroes[$h])
                                            <li {{ $h == 1 ? 'class="h2"' : '' }}><img src="{{ file_exists(public_path('/img/heroes/'.$heroes[$h].'_vertical.png')) ? asset('/img/heroes/'.$heroes[$h].'_vertical.png') : asset('/img/players/default-dark.png') }}" alt=""></li>
                                        @endisset
                                    @endfor
                                </ul>
                            </a>
                        </div>
                        <div class="tm-logo">
                            <object><a href="/{{App::getLocale()}}/team/{{$player->team->team_id}}"><img src="{{ file_exists(public_path()."/img/team/{$player->team->team_id}.png") ? asset("/img/team/{$player->team->team_id}.png") : asset('/img/team/dota-none-dark.png') }}" alt=""></a></object>
                        </div>
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
