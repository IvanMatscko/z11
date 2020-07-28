
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
                    <div class="card-header"><a href="{{ $route }}/future_matches">View</a> | Add</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ $route }}/future_matches/add">
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Match ID</label>
                                <div class="col-md-10">
                                    <input id="" name="match_id" class="form-control "/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Team 1</label>
                                <div class="col-md-10">
                                    <input list="team_list" id="" name="team_0" class="form-control "/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Team 2</label>
                                <div class="col-md-10">
                                    <input list="team_list" id="" name="team_1" class="form-control "/>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Date</label>
                                <div class="col-md-10">
                                    <input type="date" id="" name="date" class="form-control "/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Time</label>
                                <div class="col-md-10">
                                    <input type="time" id="" name="time" class="form-control "/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">League</label>
                                <div class="col-md-10">
                                    <input list="league_list" id="" name="league" class="form-control "/>
                                </div>
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
                    <div class="card-header"><a href="{{ $route }}/future_matches">View</a> | Add</div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



