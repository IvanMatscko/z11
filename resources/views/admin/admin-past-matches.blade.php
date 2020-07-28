
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
                            <div class="card-header">Past Matches</div>
                            <div class="card-header">View</div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <table class="table-secondary table-bordered" width="100%">
                                        <tr class="table-primary">
                                            <th>Series ID</th>
                                            <th>Radiant</th>
                                            <th>Dire</th>
                                            <th>League ID</th>
                                            <th>winner</th>
                                            <th width="16px"></th>
                                            <th width="16px"></th>
                                        </tr>
                                        @foreach ($data['pastMatches'] as $pastMatch)
                                        <tr>
                                        @php
                                        $inputColor = (is_null($pastMatch->winner)) ? '#e08d8d' : '';
                                        @endphp
                                            <td style="background-color: {{$inputColor}}">{{$pastMatch->series_id}}</td>
                                            <td style="background-color: {{$inputColor}}">{{$pastMatch->team_0_name}}</td>
                                            <td style="background-color: {{$inputColor}}">{{$pastMatch->team_1_name}}</td>
                                            <td style="background-color: {{$inputColor}}">{{$pastMatch->league_id}}</td>
                                            <td style="background-color: {{(is_null($pastMatch->winner)) ? $inputColor : (($pastMatch->winner === 1) ? '#33CC33' : '#CC3333')}}">{{(is_null($pastMatch->winner)) ? '' : (($pastMatch->winner === 1) ? 'Radiant' : 'Dire')}}</td>
                                            <td><a href="{{$route}}/past_matches/edit/{{$pastMatch->match_id}}">Edit</a></td>
                                            <td><a href="{{$route}}/past_matches/delete/{{$pastMatch->match_id}}" onclick="return confirm('Are you sure?')">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
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



