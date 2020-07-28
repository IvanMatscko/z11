@extends('layouts.blank')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="content result-page">
        <div class="side-container">

            @if(isset($past_matches_of_month) && count($past_matches_of_month) > 0)
                <div class="result-slider">
                    @foreach ($past_matches_of_month as $date => $matches)
                        <div id="row-{{ \Carbon\Carbon::parse($date)->format('d_m') }}_display_container" data-row-number="{{ $loop->index }}_display_container" style="display: none;" class="result-block @if($loop->first) today @endif">
                        </div>
                        <div id="row-{{ \Carbon\Carbon::parse($date)->format('d_m') }}" data-row-number="{{ $loop->index }}" class="result-block @if($loop->first) today @endif">
                            <div class="scroll-pane">
                                <div class="result-title">
                                    <p>
                                        @if(\Carbon\Carbon::parse($date)->isToday())
                                            <span>{{ __('l.days.today') }}</span> ({{ $date ?? '' }})
                                        @elseif(\Carbon\Carbon::parse($date)->isYesterday())
                                            <span>{{ __('l.days.yesterday') }}</span> ({{ $date ?? '' }})
                                        @else
                                            {{ $date ?? '' }}
                                        @endif
                                    </p>
                                </div>
                                @if(isset($matches) && count($matches) > 0)
                                    <ul class="match-list-info">
                                        @foreach ($matches as $k => $match)

                                            <li class="last open" data-match-id="{{ $match->lm_id}}">
                                                <ul class="postMenu">
                                                    @php
                                                        $mapWin = $match->dire_win_maps !== '' && !is_null($match->dire_win_maps) ? explode(',',$match->dire_win_maps) : false;
                                                    @endphp
                                                    @if (!is_array($mapWin) || empty($mapWin))

                                                    @else
                                                        @foreach ($mapWin as $mapWinNumber)
                                                            <li class="red"><a id="{{$match->series_id}}" class="postLink map_number" href="#" >map {{$mapWinNumber}}</a></li>
                                                        @endforeach

                                                    @endif

                                                    @php
                                                        $mapWin = $match->radiant_win_maps !== '' && !is_null($match->radiant_win_maps) ? explode(',',$match->radiant_win_maps) : false;
                                                    @endphp
                                                    @if (!is_array($mapWin) || empty($mapWin))

                                                    @else
                                                        @foreach ($mapWin as $mapWinNumber)
                                                            <li class="red"><a id="{{$match->series_id}}" class="postLink map_number" href="#" >map {{$mapWinNumber}}</a></li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                                <div class="match-item">
                                                    <div class="leftTeam {{ ($match->radiant_win_in_series > $match->dire_win_in_series) ? 'win' : '' }}">
                                                        <span class="nameTeam">{{ $match->lm_team_0_name ?? '' }}</span>
                                                        @if (\Illuminate\Support\Facades\File::exists(public_path('/img/team/'.$match->lm_team_0.'.png')))
                                                            <div class="imgTeam">
                                                                <a href="/{{App::getLocale()}}/team/{{$match->lm_team_0}}"><img src="{{ asset('/img/team/'.$match->lm_team_0.'.png') }}" alt="{{ $match->lm_team_0_name }}"></a>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $maps_radiant_win = $match->radiant_win_maps !== '' && !is_null($match->radiant_win_maps) ? explode(',', $match->radiant_win_maps) : [];
                                                        @endphp
                                                        @if (isset($maps_radiant_win) || !empty($maps_radiant_win))
                                                            <ul class="shields">
                                                                @foreach ($maps_radiant_win as $radiant_win)
                                                                    <li class="red">{{ $radiant_win }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                    <div class="centerTime">
                                                        <span class="countTeam">{{ $match->radiant_win_in_series ?? 0 }} - {{ $match->dire_win_in_series ?? 0 }}</span>
                                                        @if (\Illuminate\Support\Facades\File::exists(public_path('/img/league/'.$match->league_id.'.png')))
                                                            <span class="ligaTeam">
                                                                <a href="/{{App::getLocale()}}/league/{{$match->league_id}}"><img src="{{ asset('/img/league/'.$match->league_id.'.png') }}" alt="League {{ $match->league_id ?? 0 }}"></a>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="rightTeam {{ ($match->dire_win_in_series > $match->radiant_win_in_series) ? 'win' : '' }}">
                                                        <span class="nameTeam">{{ $match->lm_team_1_name ?? '' }}</span>
                                                        @if (\Illuminate\Support\Facades\File::exists(public_path('/img/team/'.$match->lm_team_1.'.png')))
                                                            <div class="imgTeam">
                                                                <a href="/{{App::getLocale()}}/team/{{$match->lm_team_1}}"><img src="{{ asset('/img/team/'.$match->lm_team_1.'.png') }}" alt="{{ $match->lm_team_1_name }}"></a>
                                                            </div>
                                                        @endif
                                                        @php
                                                            $maps_dire_win = $match->dire_win_maps !== '' && !is_null($match->dire_win_maps) ? explode(',', $match->dire_win_maps) : [];
                                                        @endphp
                                                        @if (isset($maps_dire_win) || !empty($maps_dire_win))
                                                            <ul class="shields">
                                                                @foreach ($maps_dire_win as $dire_win)
                                                                    <li class="red">{{$dire_win}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="result_popup">
                @include('layouts.match_past_popup')
                <script>
                    $('.result_popup .match-list-info .last').click(function(e) {
                        if($('.result_popup .postMenu').hasClass('active')){
                            $('.result_popup .postMenu').removeClass('active');
                            $('.result_popup .open').removeClass('active');

                        }else{
                            $(this).children('.result_popup .postMenu').addClass('active');
                            $(this).addClass('active');
                        }
                    });

                </script>
            </div>

        </div>
        <div class="side-calend">
            <div id="datepicker" class="datepicker"></div>
        </div>
    </div>

@endsection
@section('footer')
    @include('layouts.footer')
@endsection
