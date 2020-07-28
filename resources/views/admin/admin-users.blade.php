
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
                            <div class="card-header">Users</div>

                            <div class="card-body">
                                @if ($users->count() > 0)
                                    <table class="table w-100">
                                        <thead class="thead">
                                        <tr>
                                            <th scope="col">LOGIN</th>
                                            <th scope="col">EMAIL</th>
                                            <th scope="col">ROLE</th>
                                            <th scope="col">CREATED AT</th>
                                            <th scope="col">ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <th>{{ $user->login }}</th>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->created_at->format('H:i Y-m-d') }}</td>
                                                <td>-</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                @else
                                    <div class="row">
                                        <div class="col text-center">
                                            <a class="btn btn-primary btn-lg" href="#">No users in DB</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{ $users->render('layouts.paginate') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection



