
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
                        <form method="POST" action="{{ $route }}/teams/edit">
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Team ID</label>
                                <div class="col-md-10">
                                    <input id="" name="team_id" class="form-control "/>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                </div>
                            </div>

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



