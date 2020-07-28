
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
                            <div class="card-header">Configuration</div>

                            <div class="card-body">
                                <form method="POST" action="{{ $route }}">
                                    @foreach ($data['params'] as $param_key => $param_value)
                                        <div class="form-group row">

                                            <label for="email" title="@if ($param_value['comment']){{$param_key}}@else{{$param_value['comment']}}@endif" class="col-md-4 col-form-label text-md-right">@if ($param_value['comment']){{$param_value['comment']}}@else{{$param_key}}@endif</label>
                                            <div class="col-md-8">
                                                <input style="background-color: #000000;" type="text" class="form-control " name="dota2_configure[{{$param_key}}][value]" value="{{$param_value['value']}}">
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="form-group row mb-0">
                                        <div class="col-md-2 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Save
                                            </button>
                                        </div>
                                    </div>
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



