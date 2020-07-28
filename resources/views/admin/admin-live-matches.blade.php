
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
                            <div class="card-header">Live Matches</div>
                            <div class="card-header">View</div>
                            <div class="card-body">
                                <form method="POST" action="{{ $route }}/live_matches">
                                    <div class="form-group row">
                                        <table class="table-secondary table-bordered" width="100%">
                                            <tr class="table-primary">
                                                <th>Match ID</th>
                                                <th>Team 1</th>
                                                <th>Team 2</th>
                                                <th width="16px"></th>
                                                <th width="16px"></th>
                                                <th width="16px"></th>
                                            </tr>
                                            @foreach ($data['liveMatches'] as $liveMatch)
                                            <tr>
                                                @php
                                                $inputColor = ($liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_L') || $liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_TIME_START_L')) ? '#c6dff5' : '';
                                                $textColor = ($liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_L') || $liveMatch->MStatus == env('MSTATUS_LIVE_GET_STATS_TIME_START_L')) ? '#000000' : '';
                                                @endphp
                                                <td style="background-color: {{$inputColor}}; color: {{$textColor}}">{{ $liveMatch->match_id }}</td>
                                                <td style="background-color: {{$inputColor}}; color: {{$textColor}}">{{$liveMatch->team_name_radiant}}</td>
                                                <td style="background-color: {{$inputColor}}; color: {{$textColor}}">{{$liveMatch->team_name_dire}}</td>
                                                <td><a href="{{ $route }}/live_matches/edit/{{$liveMatch->match_id}}">Edit</a></td>
                                                <td><a href="{{ $route }}/live_matches/close/{{$liveMatch->match_id}}" onclick="return confirm('Are you sure?')">Close</a></td>
                                                <td><a href="{{ $route }}/live_matches/delete/{{$liveMatch->match_id}}" onclick="return confirm('Are you sure?')">Delete</a></td>
                                            </tr>
                                            @endforeach
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



