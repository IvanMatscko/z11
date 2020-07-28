
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
                            <div class="card-header"><a href="{{ $data['route'] }}/past_matches">View</a> | Edit</div>
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
                                <form method="POST" action="{{ $data['route'] }}/past_matches/edit/{{$data['past_match']->match_id}}" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="email" class="col-md-2 col-form-label text-md-right">Match ID</label>
                                        <div class="col-md-10" style="line-height: 36px;">
                                            {{$data['past_match']->match_id}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Radiant</label>
                                        <div class="col-md-10" style="line-height: 36px;">
                                            {{$data['past_match']->team_0_name}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">Dire</label>
                                        <div class="col-md-10" style="line-height: 36px;">
                                            {{$data['past_match']->team_1_name}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-2 col-form-label text-md-right">winner</label>
                                        <div class="col-md-10">
                                            <input type="radio" id="winner0" name="winner" value="null" {{($data['past_match']->winner === 0 || $data['past_match']->winner === 1) ? '' : 'checked'}}><label for="winner0" style="width: 80%; line-height: 36px;"> ?</label><br>
                                            <input type="radio" id="winner1" name="winner" value="radiant" {{($data['past_match']->winner === 1) ? 'checked' : ''}}><label for="winner1" style="width: 80%; line-height: 36px; color: #3ecc6a"> Radiant</label><br>
                                            <input type="radio" id="winner2" name="winner" value="dire" {{($data['past_match']->winner === 0) ? 'checked' : ''}}><label for="winner2" style="width: 80%; line-height: 36px; color: #e64141"> Dire</label><br>
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
                            <div class="card-header"><a href="{{ $data['route'] }}/past_matches">View</a> | Edit</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection


    
