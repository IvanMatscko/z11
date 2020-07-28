
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
                            <div class="card-header">View | <a href="{{ $route }}/teams/add">Add</a> | <a href="{{ $route }}/teams/edit">Edit</a></div>

                            <div class="card-body">
                                <form method="POST" action="{{ $route }}/teams">
                                    <div class="form-group row">
                                        <table class="table-secondary table-bordered" width="100%">
                                            <tr class="table-primary">
                                                <th width="64">ID</th>
                                                <th>Name</th>
                                                <th>Tag</th>
                                                <th>logo</th>
                                                <th>country</th>
                                                <th width="16px"></th>
                                                <th width="16px"></th>
                                            </tr>
                                            @foreach ($data['teams'] as $team)
                                            <tr>
                                                <td>{{ $team->team_id }}</td>
                                                <td><input style="background-color: #000000;" type="text" class="form-control " name="team[{{$team->team_id}}][team_name]" value="{{ $team->team_name }}"></td>
                                                <td><input style="background-color: #000000;" type="text" class="form-control " name="team[{{$team->team_id}}][team_tag]" value="{{ $team->team_tag }}"></td>
                                                <td><img src="/img/team/{{$team->team_id}}.png" width="80"></td>
                                                <td><img src="/img/flag/{{strtoupper($team->country_code)}}.png" width="80"></td>
                                                <td><input type="checkbox" class="" name="team[{{$team->team_id}}][display]" @if ($team->display) {{ 'checked' }} @endif ></td>
                                                <td><a href="{{ $route }}/teams/del/{{ $team->team_id }}">X</a></td>
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
                                </form>
                            </div>
                            <div class="card-header">View | <a href="{{ $route }}/teams/add">Add</a> | <a href="{{ $route }}/teams/edit">Edit</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



