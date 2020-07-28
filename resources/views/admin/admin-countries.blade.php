
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
                            <div class="card-header">Countries</div>

                            <div class="card-body">
                                <form method="POST" action="{{ $route }}/countries">
                                    <div class="form-group row">
                                        <table class="table-secondary table-bordered" width="100%">
                                            <tr class="table-primary">
                                                <th width="40">tag</th>
                                                <th>name</th>
                                                <th width="84"></th>
                                            </tr>
                                            @foreach ($data['countries'] as $country)
                                            <tr>
                                                <td>{{$country->country_tag}}</td>
                                                <td>{{ $country->country_name }}</td>
                                                <td><img src="/img/flag/{{$country->country_tag}}.png" width="80"></td>
                                            </tr>
                                            @endforeach
                                        </table>
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



