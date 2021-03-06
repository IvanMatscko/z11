@extends('admin.layouts.admin-blank')
@section('admin-header')
    @include('admin.layouts.admin-header')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/chosen.css') }}">
@stop
@section('admin-content')
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Leagues</div>
                            <div class="card-header"><a href="{{ $route }}/leagues">View</a> | <a href="{{ $route }}/leagues/add">Add</a> | Edit</div>
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
                                @if (\Illuminate\Support\Facades\File::exists(public_path('/img/league/'.$data['league']->league_id.'.png')))
                                    <center><img src="{{ asset('/img/league/'.$data['league']->league_id.'.png') }}"></center>
                                @endif<br />
                                <form method="POST" action="{{ $route }}/leagues/edit/{{ $data['league']->LID }}" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="email" class="col-md-2 col-form-label text-md-right">League ID</label>
                                        <div class="col-md-10">
                                            <input id="" name="league_id" class="form-control" value="{{$data['league']->league_id}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Name</label>
                                        <div class="col-md-10">
                                            <input id="" name="name_EN" class="form-control" value="{{$data['league']->name_EN}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Tournament Url</label>
                                        <div class="col-md-10">
                                            <input id="" name="tournament_url" class="form-control" value="{{$data['league']->tournament_url}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">League Logo</label>
                                        <div class="col-md-10">
                                            <input type="file" accept=".png" id="" name="league_logo" class="form-control "/>
                                        </div>
                                    </div>
                                    @if(isset($teams))
                                        <div class="form-group row">
                                            <label for="teams" class="col-md-2 col-form-label text-md-right">Teams</label>
                                            <div class="col-md-10">
                                                <select data-placeholder="Choose a teams..."  class="form-control chosen-select" name="teams[]" size="10" id="teams" multiple>
                                                    @foreach($teams as $k => $team)
                                                        <option value="{{ $team->team_id }}" @if(array_keys($data['leagues_to_team_keys'], $team->team_id)) selected @endif>{{ $team->team_id }} - {{ $team->team_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Start Time</label>
                                        <div class="col-md-4">
                                            <input type="datetime-local" id="" name="start_time" value="{{ \Carbon\Carbon::parse($data['league']->start_time)->format('Y-m-d\TH:s') }}" class="form-control">
                                        </div>
                                        <label for="" class="col-md-2 col-form-label text-md-right">End Time</label>
                                        <div class="col-md-4">
                                            <input type="datetime-local" id="" name="end_time" value="{{ \Carbon\Carbon::parse($data['league']->end_time)->format('Y-m-d\TH:s') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-md-2 col-form-label text-md-right">Status</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" @if($data['league']->LStatus == 1) selected @endif>Live</option>
                                                <option value="2" @if($data['league']->LStatus == 2) selected @endif>Future</option>
                                                <option value="0" @if($data['league']->LStatus == 0) selected @endif>Past</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-2 col-form-label text-md-right">Поле для чисел</label>
                                        <div class="col-md-10">
                                            <input id="" type="number" name="number" class="form-control" placeholder="{{$data['league']->number}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Stream</label>
                                        <div class="col-md-10">
                                            @if (!isset($data['streams']) || empty($data['streams']))
                                            @else
                                                <select name="stream_id">
                                                    <option value="0"></option>
                                                @foreach ($data['streams'] as $stream)
                                                    <option value="{{$stream->id}}" {{($data['league']->stream_id && $stream->id == $data['league']->stream_id) ? 'selected' : ''}}>{{$stream->channel}}</option>
                                                @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="teams" class="col-md-2 col-form-label text-md-right">BO</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="BO" id="BO">
                                                @foreach ($data['BO'] as $BO)
                                                    <option value="{{$BO}}" {{($data['league']->BO === $BO) ? 'selected' : ''}}>{{$BO}}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                            <div class="card-header"><a href="{{ $route }}/leagues">View</a> | <a href="{{ $route }}/leagues/add">Add</a> | Edit</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('scripts')
    <script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('/js/chosen.jquery.min.js') }}"></script>
    <script>
        $(function () {
            $(".chosen-select").chosen({max_selected_options: 18, no_results_text: "Oops, nothing found!"});
        });
    </script>
@stop
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



