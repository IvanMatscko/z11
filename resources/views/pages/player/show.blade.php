@extends('layouts.blank')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="content content-page">
        <div class="page-left">
            <div class="team-div player-div">
                <div class="t-logo">
                    <div class="logo-wrap">
                        @if(\Illuminate\Support\Facades\File::exists(public_path("/img/players/{$player->account_id}.png")))
                            <img src="{{ asset("/img/players/{$player->account_id}.png") }}" alt="{{ $player->name ?? '' }}">
                        @endif
                    </div>
                </div>
                <div class="t-info">
                    <div class="left-info">
                        <p class="p-name"><a href="#">{{ $player->name ?? '' }}</a></p>
                        <p class="p-rate">{{ __('l.position') }} {{ $player->position ?? '' }}</p>
                        <p class="p-rate"><span>{{ $player->age ?? '' }}</span></p>
                        {{--
                            <p class="p-cash">$ 72 200</p>
                            <a href="" class="btn-to-info">{{ __('l.info') }}</a>
                        --}}
                    </div>
                    <div class="right-info">
                        <div class="t-command">
                        @if(\Illuminate\Support\Facades\File::exists(public_path("/img/team/{$player->team_id}.png"))) <a href="/{{App::getLocale()}}/team/{{$player->team_id}}"><img src="{{ asset("/img/team/{$player->team_id}.png") }}" alt="{{ $player->team_name ?? '' }}"></a> @endif
                        </div>
                        <div class="t-country">
                            <img src="{{ asset("/img/flag/" . Str::upper($player->country_code) . ".png") }}" alt="{{ $player->team_name ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="t-last-command {{--scroll-pane--}}">
                    <div class="za-bottom-banner l_command">
                        <div class="in_development_bottom_banner_logo"></div>
                        <div class="in_development_bottom_banner">{{ __('l.in_development') }}</div>
                    </div>
                    {{--<ul>
                        <li class="first-li"><span>{{ __('l.previous_teams') }}:</span></li>
                        <li>
                            <div class="comnd-div">
                                <img src="/img/last-com1.png" alt="">
                            </div>
                            <p class="win-r"> Winrate: <span>57%</span></p>
                            <p class="date-r"><span>11.10.2019</span></p>
                        </li>

                        <li>
                            <div class="comnd-div">
                                <img src="/img/last-com2.png" alt="">
                            </div>
                            <p class="win-r"> Winrate: <span>39%</span></p>
                            <p class="date-r"><span>07.11.2019</span></p>
                        </li>

                        <li>
                            <div class="comnd-div">
                                <img src="/img/last-com1.png" alt="">
                            </div>
                            <p class="win-r"> Winrate: <span>57%</span></p>
                            <p class="date-r"><span>11.10.2019</span></p>
                        </li>

                        <li>
                            <div class="comnd-div">
                                <img src="/img/last-com2.png" alt="">
                            </div>
                            <p class="win-r"> Winrate: <span>39%</span></p>
                            <p class="date-r"><span>07.11.2019</span></p>
                        </li>
                    </ul>--}}
                </div>
                <div class="liner"></div>
                <div class="last-patch">
                    <div class="filter-patch">
                        <div class="za-bottom-banner filter_fields">
                            <div class="in_development_bottom_banner_logo"></div>
                            <div class="in_development_bottom_banner">{{ __('l.in_development') }}</div>
                        </div>
                        {{--<img src="{{ asset('/img/player_filter.png') }}">--}}
                        {{--<p class="title">{{ __('l.filter') }}</p>
                        <p>{{ __('l.filter') }} 1</p>
                        <input type="text">
                        <p>{{ __('l.filter') }} 2</p>
                        <input type="text">
                        <p>{{ __('l.filter') }} 3</p>
                        <input type="text">--}}
                    </div>
                    <ul class="list">
                        @if(isset($most_popular_heroes))
                            @foreach ($most_popular_heroes as $hero_id => $games)
                                <li class="li-item">
                                    <p class="wrate">Winrate: <span>{{ (int)($percents_won_hero[$hero_id]['won'] / $percents_won_hero[$hero_id]['total'] * 100)  }}%</span></p>
                                    <div class="size85 hero-avatar" @if(\Illuminate\Support\Facades\File::exists(public_path('/img/heroes/'.$hero_id.'_vertical.png'))) style="background-image: url('/img/heroes/{{$hero_id}}_vertical.png')" @endif></div>
                                    <p class="kda">{{ __('l.KDA') }}: <span>{{ (int)($percents_won_hero[$hero_id]['kill'] / $percents_won_hero[$hero_id]['total']) ?? 0 }}/{{ (int)($percents_won_hero[$hero_id]['death'] / $percents_won_hero[$hero_id]['total']) ?? 0 }}/{{ (int)($percents_won_hero[$hero_id]['assists'] / $percents_won_hero[$hero_id]['total']) ?? 0 }}</span></p>
                                    {{--<p>{{ __('l.EVM') }}: <span>290</span></p>
                                    <p>{{ __('l.OVM') }}: <span>353</span></p>--}}
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @if(count($player_matches) > 0)
                <div class="team-games player">
                    <ul>
                        @foreach($player_matches as $key => $match)
                            @php
                                if ($match->team_0 == $player->team_id)
                                {
                                    $left_number = '0';
                                    $right_number = '1';
                                    $left_force = 'radiant';
                                    $right_force = 'dire';
                                } else
                                {
                                    $left_number = '1';
                                    $right_number = '0';
                                    $left_force = 'dire';
                                    $right_force = 'radiant';
                                }
                            @endphp
                            <li class="{{ ($match->winner == $left_number) ? '' : 'win' }}">
                                <div class="g-teams">
                                    <a href="/{{App::getLocale()}}/team/{{$match->{'team_'.$left_number} }}" class="left-t"><img src="{{ asset('/img/team/'.$match->{'team_'.$left_number}.'.png') }}" alt="{{ $match->{'team_'.$left_number.'_name'} ?? '' }}"></a>
                                    <div class="g-count">
                                        <span>{{ $match->{'team_'.$left_number.'_score'} ?? 0 }}:{{ $match->{'team_'.$right_number.'_score'} ?? 0 }}</span>
                                    </div>
                                    <a href="/{{App::getLocale()}}/team/{{$match->{'team_'.$right_number} }}" class="right-t"><img src="{{ asset('/img/team/'.$match->{'team_'.$right_number}.'.png') }}" alt="{{ $match->{'team_'.$right_number.'_name'} ?? '' }}"></a>
                                </div>

                                <div class="g-liga g-hero">
                                    <div class="size48 hero-avatar" @if(\Illuminate\Support\Facades\File::exists(public_path('/img/heroes/'.$player_hero_in_match[$key]['heroid'].'_vertical.png'))) style="background-image: url('/img/heroes/{{$player_hero_in_match[$key]['heroid']}}_vertical.png')" @endif></div>
                                </div>

                                <div class="g-date">
                                    <span class="day">{{ $player_hero_in_match[$key]['kill_count'] ?? 0 }}/{{ $player_hero_in_match[$key]['death_count'] ?? 0 }}/{{ $player_hero_in_match[$key]['assists_count'] ?? 0 }}</span>
                                    {{--<span class="clock">290/353</span>--}}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

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
