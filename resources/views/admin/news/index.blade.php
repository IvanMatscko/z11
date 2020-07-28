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
                        <div class="card-header d-flex">Banned sources <a class="btn btn-primary btn-sm ml-auto" href="{{ route('news.admin.create-ban') }}">add to ban list</a></div>

                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <table class="table w-100">
                                        <thead class="thea">
                                        <tr>
                                            <th scope="col">NAME</th>
                                            <th scope="col">SOURCE</th>
                                            <th scope="col">CREATED AT</th>
                                            <th scope="col">ACTIONS</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sourcesBanned as $source)
                                            <tr>
                                                <td>{{ '@'.$source->name }}</td>
                                                <td>{{ $source->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('news.admin.destroy-ban', $source->id) }}" class="btn btn-sm btn-danger">delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $sourcesBanned->render('layouts.paginate') }}
                                </div> {{--END CARD BODY--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex">Telegram sources for parsing news <a class="btn btn-primary btn-sm ml-auto" href="{{ route('news.admin.create') }}">Create source</a></div>

                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <table class="table w-100">
                                        <thead class="thead">
                                        <tr>
                                            <th scope="col">NAME</th>
                                            <th scope="col">SOURCE</th>
                                            <th scope="col">TYPE</th>
                                            <th scope="col">LOCALE</th>
                                            <th scope="col">GAME</th>
                                            <th scope="col">CREATED AT</th>
                                            <th scope="col">ACTIONS</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sources as $source)
                                            <tr>
                                                <td>{{ $source->name }}</td>
                                                <td>{{ '@'.$source->source }}</td>
                                                <td>{{ $source->type }}</td>
                                                <td>{{ $source->locale }}</td>
                                                <td>{{ $source->game }}</td>
                                                <td>{{ $source->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('news.edit', $source->id) }}" class="btn btn-sm btn-primary">edit</a>
                                                    <a href="{{ route('news.admin.ban', $source->id) }}" class="btn btn-sm btn-secondary">ban</a>
                                                    <a href="{{ route('news.admin.destroy', $source->id) }}" class="btn btn-sm btn-danger">delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{ $sources->render('layouts.paginate') }}
                                </div> {{--END CARD BODY--}}
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



