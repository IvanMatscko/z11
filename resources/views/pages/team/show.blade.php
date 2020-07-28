@extends('layouts.blank')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="content content-page">
        <div class="page-left">
            <div class="team-div">
                <div class="t-logo">
                    <div class="logo-wrap">
                        <img src="{{ asset("/img/team/{$team->team_id}.png") }}" alt="{{ $team->team_name ?? '' }}">
                    </div>
                </div>

                <div class="t-info">
                    <div class="left-info">
                        <p class="p-name">{{ $team->team_name ?? '' }}</p>
                        <p class="p-rate">Winrate: <span>{{ $percent_winrate ?? 0 }}%</span></p>
                        <div class="za-bottom-banner player">
                            <div class="in_development_bottom_banner_logo"></div>
                            <div class="in_development_bottom_banner">{{ __('l.in_development') }}</div>
                        </div>
                        {{--<img src="{{ asset('/img/team_info.png') }}">--}}
                        {{--<p class="p-cash">$ 72 200</p>
                        <a href="" class="btn-to-info">{{ __('l.info') }}</a>--}}
                    </div>
                    <div class="right-info">
                        @if(isset($team_trainer))
                        <div class="t-player">
                            @if(\Illuminate\Support\Facades\File::exists(public_path("/img/players/".$team_trainer->trainer_id.".png")))
                                <img src="{{ asset("/img/players/{$team_trainer->trainer_id}.png") }}"  alt="{{ $team->team_name ?? '' }}">
                            @endif
                        </div>
                        @endif
                        <div class="t-country">
                            <img src="{{ asset("/img/flag/" . Str::upper($team->country_code) . ".png") }}" alt="{{ $team->team_name ?? '' }}">
                        </div>
                    </div>
                </div>

                <div class="t-games {{--scroll-pane--}}">
                    <div class="za-bottom-banner l_command">
                        <div class="in_development_bottom_banner_logo"></div>
                        <div class="in_development_bottom_banner">{{ __('l.in_development') }}</div>
                    </div>
                </div>

                <div class="liner"></div>

                <div class="t-players">
                    <ul>
                        @if(isset($team_players))
                            @foreach ($team_players as $k => $player)
                            
                                <li>
                                    <a href="/{{App::getLocale()}}/player/{{$player['accountid']}}">{{ $player['name'] ?? '' }}</a>
                                    <div class="img-wrap" style="cursor: pointer;" onclick="location.href='/{{App::getLocale()}}/player/{{$player['accountid']}}';">
                                        @if(\Illuminate\Support\Facades\File::exists(public_path('/img/players/'.$player['accountid'].'.png')))
                                            <img src="{{ asset('/img/players/'.$player['accountid'].'.png') }}" alt="{{ $player['name'] ?? '' }}">
                                        @endif
                                    </div>
                                    <div class="t-player-num">{{ $player['position'] ?? 0 }}</div>
                                    @if(isset($player['hero_ids']))
                                        <ul class="t-player-heroes">
                                            @foreach($player['hero_ids'] as $k => $hero_id)
                                            <li @if ($loop->iteration == 2) class="h2" @endif>
                                                <div class="size48b hero-avatar" style="background-image: url('/img/heroes/{{ $hero_id }}_vertical.png')"></div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    </a>
                                </li>
                            
                            @endforeach
                        @endif
                    </ul>
                </div>

            </div>

            @if (count($team_matches) > 0)
                <div class="team-games">
                    <ul>
                        @foreach ($team_matches as $match)
                            <li data-match-id="{{ $match['match_id'] }}" class="{{ ($match['radiant_win_in_series'] > $match['dire_win_in_series']) ? 'win' : '' }}">
                                <div class="g-teams">
                                    <a href="/{{App::getLocale()}}/team/{{$match['team_0']}}" class="left-t"><img src="{{ asset('/img/team/'.$match['team_0'].'.png') }}" alt="{{ $match['team_0_name'] ?? '' }}"></a>
                                    <div class="g-count">
                                        <span>{{ $match['radiant_win_in_series'] ?? 0 }}:{{ $match['dire_win_in_series'] ?? 0 }}</span>
                                    </div>
                                    <a href="/{{App::getLocale()}}/team/{{$match['team_1']}}" class="right-t"><img src="{{ asset('/img/team/'.$match['team_1'].'.png') }}" alt="{{ $match['team_1_name'] ?? '' }}"></a>
                                </div>
                                <div class="g-liga">
                                    <a href="/{{App::getLocale()}}/league/{{$match['league_id']}}" class="right-t"><img src="{{ asset('/img/league/'.$match['league_id'].'.png') }}" alt=""></a>
                                </div>
                                <div class="g-date">
                                    <span class="day">{{ $match['match_day'] ?? '01.01' }}</span>
                                    <span class="clock">{{ $match['match_hour'] ?? '00:00' }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
        </div>
        @endif

        <div class="page-right">
            <div class="table-match-right">
                <ul class="head-menu">
                    <li class="active">{{ __('l.live') }}</li>
                    <li>{{ __('l.future') }}</li>
                    <li>{{ __('l.past') }}</li>
                </ul>

                @if(isset($all_leagues))
                    <div class="table-div">
                        @if(isset($all_leagues[1]))
                            <ul class="tabs__content active">
                                @foreach ($all_leagues[1] as $live)
                                    <li>
                                        <div class="img-c">
                                            <img src="{{ asset('/img/league/'.$live->league_id.'.png') }}" alt="{{ $live->name_EN ?? '' }}" style="width: 90px">
                                        </div>
                                        <div class="name-c">
                                            <a href="{{ route('tournament', [request()->segment(1), $live->LID]) }}">{{ $live->name_EN ?? '' }}</a>
                                        </div>
                                        <div class="date-c">
                                            <span>{{ \Carbon\Carbon::parse($live->start_time)->format('d.m.Y') ?? '' }} - {{ \Carbon\Carbon::parse($live->end_time)->format('d.m.Y') ?? '' }}</span>
                                        </div>
                                        {{--<div class="rate-c">
                                            <div class="rate-div">
                                                <span class="rate-num">5</span>
                                                <div class="rate-line">
                                                    <span class="active" style="width: 100%;"></span>
                                                </div>
                                            </div>
                                        </div>--}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(isset($all_leagues[2]))
                            <ul class="tabs__content scroll-pane">
                                @foreach ($all_leagues[2] as $future)
                                    <li>
                                        <div class="img-c">
                                            <img src="{{ asset('/img/league/'.$future->league_id.'.png') }}" alt="{{ $future->name_EN ?? '' }}" style="width: 90px">
                                        </div>
                                        <div class="name-c">
                                            <a href="{{ route('tournament', [request()->segment(1), $future->LID]) }}">{{ $future->name_EN ?? '' }}</a>
                                        </div>
                                        <div class="date-c">
                                            <span>{{ \Carbon\Carbon::parse($future->start_time)->format('d.m.Y') ?? '' }} - {{ \Carbon\Carbon::parse($future->end_time)->format('d.m.Y') ?? '' }}</span>
                                        </div>
                                        {{--<div class="rate-c">
                                            <div class="rate-div">
                                                <span class="rate-num">5</span>
                                                <div class="rate-line">
                                                    <span class="active" style="width: 100%;"></span>
                                                </div>
                                            </div>
                                        </div>--}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(isset($all_leagues[0]))
                            <ul class="tabs__content scroll-pane">
                                @foreach ($all_leagues[0] as $past)
                                    <li>
                                        <div class="img-c">
                                            <img src="{{ asset('/img/league/'.$past->league_id.'.png') }}" alt="{{ $past->name_EN ?? '' }}" style="width: 90px">
                                        </div>
                                        <div class="name-c">
                                            <a href="{{ route('tournament', [request()->segment(1), $past->LID]) }}">{{ $past->name_EN ?? '' }}</a>
                                        </div>
                                        <div class="date-c">
                                            <span>{{ \Carbon\Carbon::parse($past->start_time)->format('d.m.Y') ?? '' }} - {{ \Carbon\Carbon::parse($past->end_time)->format('d.m.Y') ?? '' }}</span>
                                        </div>
                                        {{--<div class="rate-c">
                                            <div class="rate-div">
                                                <span class="rate-num">5</span>
                                                <div class="rate-line">
                                                    <span class="active" style="width: 100%;"></span>
                                                </div>
                                            </div>
                                        </div>--}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </div>

            @if (isset($banners) && count($banners) > 0)
                <ul class="big-banner">
                    @foreach($banners as $banner)
                        <li>
                            <a target="_blank" href="{{ $banner->link }}">
                                <img class="d-only" src="/img/banners/{{ $banner->image_dark ?? '' }}" alt="{{ $banner->title }}" title="{{ $banner->title }}">
                                <img class="l-only" src="/img/banners/{{ $banner->image_white ?? '' }}" alt="{{ $banner->title }}" title="{{ $banner->title }}">
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
