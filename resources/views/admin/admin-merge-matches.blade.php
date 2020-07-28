
@extends('admin.layouts.admin-blank')
@section('admin-header')
    @include('admin.layouts.admin-header')
@endsection
@section('admin-content')
<main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Merge Series</div>
                            <div class="card-header">View</div>
                            <div class="card-body">
                                <form method="POST" action="{{ $route }}/merge_series">
                                    <div class="form-group row">
                                        <table class="table-secondary table-bordered" width="100%">
                                            <tr class="table-primary">
                                                <th>Type</th>
                                                <th>Team 1</th>
                                                <th>Team 2</th>
                                                <th>series id</th>
                                                <th>time</th>
                                                <th width="16px"></th>
                                            </tr>
                                            @if (!empty($data['liveMatches']))
                                                @foreach ($data['liveMatches'] as $liveMatch)
                                                <tr>
                                                    @php
                                                    $inputColor = ($liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_L') || $liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_TIME_START_L')) ? '#c6dff5' : '';
                                                    $textColor = ($liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_L') || $liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_TIME_START_L')) ? '#000000' : '';
                                                    @endphp
                                                    <td style="background-color: {{$inputColor}}; color: {{$textColor}}">Live</td>
                                                    <td style="background-color: {{$inputColor}}; color: {{$textColor}}">{{$liveMatch->team_name_radiant}}</td>
                                                    <td style="background-color: {{$inputColor}}; color: {{$textColor}}">{{$liveMatch->team_name_dire}}</td>
                                                    <td style="background-color: {{$inputColor}}; color: {{$textColor}}">{{$liveMatch->series_id}}</td>
                                                    <td style="background-color: {{$inputColor}}; color: {{$textColor}}">{{gmdate("Y-m-d H:i", $liveMatch->activate_time)}}</td>
                                                    <td><a href="{{ $route }}/merge_series/merge/{{$liveMatch->series_id}}">Merge</a></td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if (!empty($data['pastMatches']))
                                                @foreach ($data['pastMatches'] as $pastMatch)
                                                <tr>
                                                    <td>Past</td>
                                                    <td>{{$pastMatch->team_0_name}}</td>
                                                    <td>{{$pastMatch->team_1_name}}</td>
                                                    <td>{{$pastMatch->series_id}}</td>
                                                    <td>{{gmdate("Y-m-d H:i", $pastMatch->timestamp)}}</td>
                                                    <td><a href="{{ $route }}/merge_series/merge/{{$pastMatch->series_id}}">Merge</a></td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </form>
                            </div>
                            <div class="card-header">View</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



