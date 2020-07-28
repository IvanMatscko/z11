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

                        <form action="{{ route('bwords.index') }}" class="card">
                            <div class="card-body d-flex">
                                <input type="text" name="from" class="form-control" placeholder="From" value="{{ request('from') }}">
                                <input type="text" name="to" class="form-control" placeholder="To" value="{{ request('to') }}">
                                <input type="submit" class="btn btn-primary mx-3" value="search">
                                <a href="{{ route('bwords.index') }}" class="btn btn-primary">clear</a>
                            </div>
                        </form>

                        <div class="card-body">
                            @if ($words->count() > 0)
                                <table class="table w-100">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($words as $word)
                                        <tr>
                                            <th>{{ $word->from }}</th>
                                            <td>{{ $word->to }}</td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="{{ route('bwords.edit', $word->id) }}">Edit</a> |
                                                <a class="btn btn-danger btn-sm" href="{{ route('bwords.destroy', $word->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                @else
                                <div class="row">
                                    <div class="col text-center">
                                        <a class="btn btn-primary btn-lg" href="{{ route('bwords.create') }}">Create Words Changer</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{ $words->render('layouts.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



