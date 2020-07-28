
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
                            <div class="card-header">Heroes</div>
                            <div class="card-header">View</div>

                            <div class="card-body">
                                <form method="POST" action="{{ $route }}/heroes">
                                    <div class="form-group row">
                                        <table class="table-secondary table-bordered" width="100%">
                                            <tr class="table-primary">
                                                <th>ID</th>
                                                <th>EN</th>
                                                <th></th>
                                            </tr>
                                            @foreach ($data['heroes'] as $hero)
                                            <tr>
                                                <td>{{$hero->hero_id}}</td>
                                                <td>{{ $hero->localized_name_EN }}</td>
                                                <td><div style="background-image: url(/img/heroes/{{$hero->hero_id}}_vertical.png);border: 3px solid #2d2d32;border-radius: 50%;width:51px;height:51px;background-position: 50% 20%;background-size: cover;"></div></td>
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



