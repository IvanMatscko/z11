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
                        <div class="card-header">Player edit #{{$player->account_id}}</div>

                        <div class="card-body">
                            <form action="{{ route('players.update', $player) }}" method="POST" enctype="multipart/form-data">
                                @if (\Illuminate\Support\Facades\File::exists(public_path() . '/img/players/'. $player->account_id . '.png'))
                                    <img src="{{ asset('/img/players/' . $player->account_id . '.png') }}" class="img-thumbnail rounded border" width="250px">
                                @endif
                                <div class="row">
                                    <div class="col">
                                        <label for="account_id">Account ID</label>
                                        <input type="text" name="account_id" class="form-control" value="{{ old('account_id') ?? $player->account_id }}" id="account_id" required>
                                    </div>
                                    <div class="col">
                                        <label for="player_name">Name</label>
                                        <input type="text" name="player_name" class="form-control" value="{{ old('player_name') ?? $player->name }}" id="player_name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="age">Age</label>
                                        <input type="number" min="10" max="40" name="age" class="form-control" value="{{ old('age') ?? $player->age }}" id="age" required>
                                    </div>
                                    <div class="col">
                                        <label for="position">Position</label>
                                        <select class="form-control" name="position" id="position" required>
                                            @foreach($positions as $key => $position)
                                                <option value="{{ $key }}" @if ($key == $player->position) selected @endif>{{ $position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col">
                                        <label for="team">Team</label>
                                        <select class="form-control" name="team_id" id="team" required>
                                            @foreach($teams as $key => $team)
                                                <option value="{{ $team->team_id }}" @if ($team->team_id == $player->team_id) selected @endif>{{ $team->team_id }} - {{ $team->team_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col">
                                        <label for="logo">Player Logo Upload</label>
                                        <input type="file" name="player_logo" class="form-control-file" value="{{ old('player_logo') }}" id="logo" required>
                                    </div>
                                </div><br />

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

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



