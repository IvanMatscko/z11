
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
                    <div class="card-header">Future Matches</div>
                    <div class="card-header">View | <a href="{{ $route }}/future_matches/add">Add</a></div>

                    <div class="card-body">
                        <form method="POST" action="{{ $route }}/future_matches">
                            <div class="form-group row">
                                <table class="table-secondary table-bordered" width="100%">
                                    <tr class="table-primary">
                                        <th>DateTime</th>
                                        <th>Match ID</th>
                                        <th>Team 1</th>
                                        <th>Team 2</th>
                                        <th>League</th>
                                        <th width="16px"></th>
                                        <th width="16px"></th>
                                    </tr>
                                    @foreach ($data['futureMatches'] as $futureMatch)
                                    <tr>
                                        <td><input style="background-color: #000000;" type="text" class="form-control " name="futureMatch[{{$futureMatch->MFID}}][start_datetime]" value="{{$futureMatch->start_datetime}}"></td>
                                        <td><input style="background-color: #000000;" type="text" class="form-control " name="futureMatch[{{$futureMatch->MFID}}][match_id]" value="{{$futureMatch->match_id}}"></td>
                                        <td><input style="background-color: #000000;" type="text" list="team_list" class="form-control " name="futureMatch[{{$futureMatch->MFID}}][team_0]" value="{{$futureMatch->team_0_name.' - '.$futureMatch->team_0}}"></td>
                                        <td><input style="background-color: #000000;" type="text" list="team_list" class="form-control " name="futureMatch[{{$futureMatch->MFID}}][team_1]" value="{{$futureMatch->team_1_name.' - '.$futureMatch->team_1}}"></td>
                                        <td><input style="background-color: #000000;" type="text" list="league_list" class="form-control " name="futureMatch[{{$futureMatch->MFID}}][league_id]" value="{{$futureMatch->league_id}}"></td>
                                        <td><input style="background-color: #000000;" type="checkbox" class="" name="futureMatch[{{$futureMatch->MFID}}][display]" @if ($futureMatch->display){{'checked'}}@endif ></td>
                                        <td><a href="{{ $route }}/future_matches/del/{{ $futureMatch->MFID }}" onclick="return confirm('Are you sure?')">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                            <datalist id="team_list">
                                @foreach ($data['teams'] as $team)
                                    <option value="{{ $team->team_name.' - '.$team->team_id }}">
                                @endforeach
                            </datalist>
                            <datalist id="league_list">
                                @foreach ($data['leagues'] as $league)
                                    <option value="{{ $league->name_EN.' - '.$league->league_id }}">
                                @endforeach
                            </datalist>
                        </form>
                    </div>
                    <div class="card-header">View | <a href="{{ $route }}/future_matches/add">Add</a></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



