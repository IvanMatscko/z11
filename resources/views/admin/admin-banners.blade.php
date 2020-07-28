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
                        <div class="card-header">Banners <a class="btn btn-primary btn-sm text-right" href="{{ route('banners.create') }}">Create banner</a></div>

                        <div class="card-body">
                            @if ($banners->count() > 0)
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <th scope="row">{{ $banner->id }}</th>
                                            <td>{{ $banner->title }}</td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="{{ route('banners.edit', $banner->id) }}">Edit</a> |
                                                <a class="btn btn-danger btn-sm" href="{{ route('banners.destroy', $banner->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                @else
                                <div class="row">
                                    <div class="col text-center">
                                        <a class="btn btn-primary btn-lg" href="{{ route('banners.create') }}">Create banner</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{ $banners->render('layouts.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection


    
