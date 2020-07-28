@extends('layouts.blank')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="content content-page">

        <div class="page-left">
            {{--            <div class="za-bottom-banner tournament-page">--}}
            {{--                <div class="in_development_bottom_banner_logo"></div>--}}
            {{--                <div class="in_development_bottom_banner">{{ __('l.tournament_grid') }}</div>--}}
            {{--            </div>--}}
            {{--            --}}{{--<div class="tour">--}}

            {{--                <ul class="tour-menu menu-top-side">--}}
            {{--                    <li class="active"><a href="">{{ __('l.groups') }}</a></li>--}}
            {{--                    <li><a href="">{{ __('l.play_off') }}</a></li>--}}
            {{--                </ul>--}}
            {{--                <div class="tour-wrap">--}}

            {{--                </div>--}}
            {{--                <ul class="menu-top-side ver2">--}}
            {{--                    <li><a href="">{{ __('l.tournament_statistics') }}</a></li>--}}
            {{--                </ul>--}}
            {{--            </div>--}}
            <ul class="tour-nav">
                <li><a href="#" class="active">Участники</a></li>


                <li><a href="" class="side-rate-item rate-header za-top-banner"><div class="in_development_chat_logo"></div><div class="in_development_top_banner"><?php echo e(__('l.in_development')); ?></div></a></li>
                <li><a href="" class="side-rate-item rate-header za-top-banner"><div class="in_development_chat_logo"></div><div class="in_development_top_banner"><?php echo e(__('l.in_development')); ?></div></a></li>
            </ul>

            <div class="tour-list">

                <div class="container-tour scroll-pane" id="scroll">

                        @if(isset($teamData))
                            @foreach ($teamData as $k => $team)
                                <div class="div-players">
                                    <p class="tm-winrate">Winrate: <span>{{$percent_winrate[$team->team_id]}}%</span></p>

                                    <div class="pl-div">
                                        <a href="">
                                            <div class="img-wrap img-team">
                                                <a href=""><img src="{{ asset('/img/team/'.$team->team_id.'.png') }}" alt=""></a>
                                            </div>
                                            <ul class="tm-players">

                                                <li> <img src="{{ file_exists(public_path()."/img/players/" .@$team->player_0_account_id. ".png") ? asset("/img/players/" .$team->player_0_account_id. ".png") : asset('/img/heroes/unknown_dark_vertical.png') }}" alt=""></li>
                                                <li> <img src="{{ file_exists(public_path()."/img/players/" .@$team->player_1_account_id. ".png") ? asset("/img/players/" .$team->player_1_account_id. ".png") : asset('/img/heroes/unknown_dark_vertical.png') }}" alt=""></li>
                                                <li class="h2"> <img src="{{ file_exists(public_path()."/img/players/" .@$team->player_2_account_id. ".png") ? asset("/img/players/" .$team->player_2_account_id. ".png") : asset('/img/heroes/unknown_dark_vertical.png') }}" alt=""></li>
                                                <li class="h2r"> <img src="{{ file_exists(public_path()."/img/players/" .@$team->player_3_account_id. ".png") ? asset("/img/players/" .$team->player_3_account_id. ".png") : asset('/img/heroes/unknown_dark_vertical.png') }}" alt=""></li>

                                                <li class="countr"><img src="{{ file_exists(public_path()."../img/flag/" .@$team->country_code. ".png") ? asset("/img/flag/" .$team->country_code. ".png") : asset('/img/players/none-logo-dark.png') }}" alt=""></li>
                                                <li> <img src="{{ file_exists(public_path()."/img/players/" .@$team->player_4_account_id. ".png") ? asset("/img/players/" .$team->player_4_account_id. ".png") : asset('/img/heroes/unknown_dark_vertical.png') }}" alt=""></li>

                                            </ul>
                                        </a>
                                    </div>
                                    <p class="tm-name">{{ $team->team_name ?? '' }}</p>
                                </div>
                            @endforeach

                        @endif


                </div>
                <script>

                    $(window).resize(function(e) {

                        console.log("resize");
                        $('.scroll-pane').jScrollPane({
                            showArrows: true,
                            arrowScrollOnHover: true
                        });
                    });

                </script>
            </div>
        </div>
        <div class="page-right">
            <div class="table-match-right">
                <ul class="head-menu">
                    <li @if($league->LStatus == 1) class="active" @endif>{{ __('l.tabs.live') }}</li>
                    <li @if($league->LStatus == 2) class="active" @endif>{{ __('l.tabs.future') }}</li>
                    <li @if($league->LStatus == 0) class="active" @endif>{{ __('l.tabs.past') }}</li>
                </ul>
                @if(isset($all_leagues))

                    <div class="table-div">
                        <ul class="tabs__content {{ $league->LStatus == 1 ? 'active' : '' }}">
                            @if(isset($all_leagues[1]))
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
                                        <div class="date-c">
                                            <span>{{ $live->number }}</span>
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
                            @endif
                        </ul>

                        <ul class="tabs__content {{ $league->LStatus == 2 ? 'active' : '' }}">
                            @if(isset($all_leagues[2]))
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
                                        <div class="date-c">
                                            <span>{{ $future->number }}</span>
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
                            @endif
                        </ul>
                        <ul class="tabs__content {{ $league->LStatus == 0 ? 'active' : '' }}">
                            @if(isset($all_leagues[0]))
                                @foreach ($all_leagues[0] as $past)

                                    <li>
                                        <div class="img-c">
                                            <img src="{{ asset('/img/league/'.$past->league_id.'.png') }}" alt="{{ $past->name_EN ?? '' }}" style="width: 90px">
                                        </div>
                                        <div class="name-c">
                                            <a href="{{ route('tournament', [request()->segment(1), $past->LID,]) }}">{{ $past->name_EN ?? '' }}</a>
                                        </div>
                                        <div class="date-c">
                                            <span>{{ \Carbon\Carbon::parse($past->start_time)->format('d.m.Y') ?? '' }} - {{ \Carbon\Carbon::parse($past->end_time)->format('d.m.Y') ?? '' }}</span>
                                        </div>
                                        <div class="date-c">
                                            <span>{{ $past->number }}</span>
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
                            @endif
                        </ul>
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
