
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
                            <div class="card-header">Trainers</div>
                            <div class="card-header">View</div>

                            <div class="card-body">
                                <form method="POST" action="{{ $route }}/trainers">
                                    <div class="form-group row">
                                        <table class="table-secondary table-bordered" width="100%">
                                            <tr class="table-primary">
                                                <th>name</th>
                                                <th>team_id</th>
                                                <th width="16px"></th>
                                            </tr>
                                            @foreach ($data['trainers'] as $trainer)
                                            <tr>
                                                <td>{{$trainer->name}}</td>
                                                <td>{{$trainer->team_id}}</td>
                                                <td><a href="{{ $route }}/trainers/del/{{ $trainer->trainer_id }}">X</a></td>
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
                            <div class="card-header">View</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



