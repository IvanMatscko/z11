@extends('layouts.blank')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
    <div class="content result-page">
        <div class="side-container">
            @if(isset($future_matches) && count($future_matches) > 0)
            <div class="result-slider">
                @foreach ($future_matches as $date => $matches)
                    <div class="result-block" id="row-{{ \Carbon\Carbon::parse($date)->format('d_m') }}" data-row-number="{{ $loop->index }}">
                        <div class="scroll-pane">
                            <div class="result-title">
                                <p>
                                    @if(\Carbon\Carbon::parse($date)->isToday())
                                        <span>{{ __('l.days.today') }}</span> ({{ $date ?? '' }})
                                    @elseif(\Carbon\Carbon::parse($date)->isTomorrow())
                                        <span>{{ __('l.days.tomorrow') }}</span> ({{ $date ?? '' }})
                                    @else
                                        {{ $date ?? '' }}
                                    @endif
                                </p>
                            </div>
                            @if(isset($matches) && count($matches) > 0)
                            <ul class="match-list-info">
                                @foreach ($matches as $k => $match)
                                    <li class="future open" data-match-id="{{ $match->match_id}}">
                                        <div class="match-item">
                                            <div class="leftTeam">
                                                <span class="nameTeam">{{ $match->team_0_name ?? '' }}</span>
                                                @if (\Illuminate\Support\Facades\File::exists(public_path('/img/team/'.$match->team_0.'.png')))
                                                    <div class="imgTeam">
                                                        <a href="/{{App::getLocale()}}/team/{{$match->team_0}}"><img src="{{ asset('/img/team/'.$match->team_0.'.png') }}" alt="{{ $match->team_0_name }}"></a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="centerTime">
                                                <span class="infoTeam">
                                                   <span class="time">{{ \Carbon\Carbon::parse($match->start_datetime)->format('H:s') }}</span>
                                                   <span class="day">{{ \Carbon\Carbon::parse($match->start_datetime)->format('d.m') }}</span>
                                                </span>
                                                @if (\Illuminate\Support\Facades\File::exists(public_path('/img/league/'.$match->league_id.'.png')))
                                                    <span class="ligaTeam">
                                                    <a href="/{{App::getLocale()}}/league/{{$match->league_id}}"><img src="{{ asset('/img/league/'.$match->league_id.'.png') }}" alt="{{ $match->league_id ?? 0 }}"></a>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="rightTeam">
                                                <span class="nameTeam">{{ $match->team_1_name ?? '' }}</span>
                                                @if (\Illuminate\Support\Facades\File::exists(public_path('/img/team/'.$match->team_1.'.png')))
                                                    <div class="imgTeam">
                                                        <a href="/{{App::getLocale()}}/team/{{$match->team_1}}"><img src="{{ asset('/img/team/'.$match->team_1.'.png') }}" alt="{{ $match->team_1_name }}"></a>
                                                    </div>
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
        </div>
        <div class="side-calend">
            <div id="datepicker" class="datepicker"></div>
        </div>
    </div>
@endsection
@section('footer')
    @include('layouts.footer')
@endsection
