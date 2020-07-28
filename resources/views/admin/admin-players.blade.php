@extends('admin.layouts.admin-blank')

@section('admin-header')
    @include('admin.layouts.admin-header')
@endsection

@section('admin-content')
    @if (session('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {!! session('success') !!}
        </div>
    @endif
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Players <a class="btn btn-primary btn-sm text-right" href="{{ route('players.create') }}">Create player</a></div>

                        <div class="card-body">
                            @if ($players->count() > 0)
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Account ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Position</th>
                                        <th scope="col">Team</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($players as $player)
                                        <tr>
                                            <th scope="row">{{ $player->account_id }}</th>
                                            <td>{{ $player->name }}</td>
                                            <td>{{ $player->age }}</td>
                                            <td>{{ $player->position }}</td>
                                            <td>{{ $player->team->team_name }}</td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="{{ route('players.edit', $player) }}">Edit</a> |
                                                <a class="btn btn-danger btn-sm" href="{{ route('players.destroy', $player) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            @else
                                <div class="row">
                                    <div class="col text-center">
                                        <a class="btn btn-primary btn-lg" href="{{ route('players.create') }}">Create player</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection
