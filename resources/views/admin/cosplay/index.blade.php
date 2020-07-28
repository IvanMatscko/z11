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
                        <div class="card-header d-flex">Bad Words list <a class="btn btn-primary btn-sm ml-auto" href="{{ route('bwords.create') }}">Create word changer</a></div>

                        <div class="row">
                            <div class="col-6">
                                <div class="card-body">
                                    <table class="table w-100">
                                        <thead class="thea">
                                        <tr>
                                            <th scope="col">IMAGE</th>
                                            <th scope="col">CREATED AT</th>
                                            <th scope="col">ACTIONS</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($imagesNew as $image)
                                            <tr>
                                                <th><img class="w-100" src="{{ $image->thumbnail_url }}" alt=""></th>
                                                <th class="text-nowrap">{{ $image->created_at->format('H:i Y-m-d') }}</th>
                                                <td class="text-nowrap">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.cosplay.edit', [$image->id, 'saved']) }}">Save</a> |
                                                    <a class="btn btn-success btn-sm" href="{{ route('admin.cosplay.edit', [$image->id, 'deleted']) }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $imagesNew->render('layouts.paginate') }}
                                </div> {{--END CARD BODY--}}
                                </div>
                                <div class="col-6">
                                    <div class="card-body">
                                        <table class="table w-100">
                                            <thead class="thea">
                                            <tr>
                                                <th scope="col">IMAGE</th>
                                                <th scope="col">LIKES</th>
                                                <th scope="col">CREATED AT</th>
                                                <th scope="col">ACTIONS</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($imagesSaved as $image)
                                                <tr>
                                                    <th><img class="w-100" src="{{ $image->thumbnail_url }}" alt=""></th>
                                                    <th class="text-nowrap">{{ $image->likes }}</th>
                                                    <th class="text-nowrap">{{ $image->updated_at->format('H:i Y-m-d') }}</th>
                                                    <td class="text-nowrap">
                                                        <a class="btn btn-success btn-sm" href="{{ route('admin.cosplay.edit', [$image->id, 'deleted']) }}">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        {{ $imagesSaved->render('layouts.paginate') }}
                                    </div>
                                </div>
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



