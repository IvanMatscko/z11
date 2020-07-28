
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
                    <div class="card-header">Teams</div>
                    <div class="card-header"><a href="{{ $route }}/teams">View</a> | <a href="{{ $route }}/teams/add">Add</a> | Edit</div>
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
                        <center><img src="/img/team/{{$data['team_id']}}.png"></center>
                        <form method="POST" action="{{ $route }}/teams/edit/{{$data['team_id']}}" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Team ID</label>
                                <div class="col-md-10">
                                    <input id="" name="team_id" class="form-control " value="{{$data['team']->team_id}}" readonly/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Team Name</label>
                                <div class="col-md-10">
                                    <input id="" name="team_name" class="form-control " value="{{$data['team']->team_name}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Country</label>
                                <div class="col-md-10">
                                    <input list="country_code_list" id="" name="country_code" class="form-control " value="{{$data['team']->country_code}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Team Logo</label>
                                <div class="col-md-10">
                                    <input type="file" accept=".png" id="" name="team_logo" class="form-control "/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Player 1 account ID</label>
                                <div class="col-md-10">
                                    <input id="" name="player_0_account_id" class="form-control " value="{{$data['team']->player_0_account_id}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Player 2 account ID</label>
                                <div class="col-md-10">
                                    <input id="" name="player_1_account_id" class="form-control " value="{{$data['team']->player_1_account_id}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Player 3 account ID</label>
                                <div class="col-md-10">
                                    <input id="" name="player_2_account_id" class="form-control " value="{{$data['team']->player_2_account_id}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Player 4 account ID</label>
                                <div class="col-md-10">
                                    <input id="" name="player_3_account_id" class="form-control " value="{{$data['team']->player_3_account_id}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Player 5 account ID</label>
                                <div class="col-md-10">
                                    <input id="" name="player_4_account_id" class="form-control " value="{{$data['team']->player_4_account_id}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Player 6 account ID</label>
                                <div class="col-md-10">
                                    <input id="" name="player_5_account_id" class="form-control " value="{{$data['team']->player_5_account_id}}"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="" class="col-md-2 col-form-label text-md-right">Display</label>
                                <div class="col-md-10">
                                    <input id="" type="checkbox" name="display" class="form-control " style="width: 38px;" {{$data['team']->display ? 'checked' : ''}}/>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                            <datalist id="country_code_list">
                                @foreach ($data['countries'] as $country)
                                    <option value="{{ $country->country_name.' - '.$country->country_tag }}">
                                @endforeach
                            </datalist>
                        </form>
                    </div>
                    <div class="card-header"><a href="{{ $route }}/teams">View</a> | <a href="{{ $route }}/teams/add">Add</a> | Edit</div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



