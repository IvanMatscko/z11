
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
                            <div class="card-header"><a href="{{ $route }}/live_matches">View</a> | Edit</div>
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
                                <form method="POST" action="{{ $route }}/live_matches/edit/{{$data['live_match']->match_id}}" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="email" class="col-md-2 col-form-label text-md-right">Match ID</label>
                                        <div class="col-md-10">
                                            <input id="" name="match_id" class="form-control " value="{{$data['live_match']->match_id}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Name</label>
                                        <div class="col-md-10">
                                            <input id="" name="team_id_radiant" class="form-control " value="{{$data['live_match']->team_name_radiant}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Name</label>
                                        <div class="col-md-10">
                                            <input id="" name="team_id_dire" class="form-control " value="{{$data['live_match']->team_name_dire}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Stream</label>
                                        <div class="col-md-10">
                                            @if (!isset($data['streams']) || empty($data['streams']))

                                            @else
                                                <select name="MStreamID">
                                                    <option value="0"></option>
                                                @foreach ($data['streams'] as $stream)
                                                    <option value="{{$stream->id}}" {{($data['live_match']->MStreamID && $stream->id == $data['live_match']->MStreamID) ? 'selected' : ''}}>{{$stream->channel}}</option>
                                                @endforeach
                                                </select>
                                            @endif
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
                            <div class="card-header"><a href="{{ $route }}/live_matches">View</a> | Edit</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



