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
                            <div class="card-header">Streams <a class="btn btn-primary btn-sm text-right" href="{{ route('streams.create') }}">Create stream</a></div>

                            <div class="card-body">
                                @if ($streams->count() > 0)
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Channel</th>
                                            <th scope="col">Link To channel</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($streams as $stream)
                                            <tr>
                                                <th scope="row">{{ $stream->id }}</th>
                                                <td>{{ $stream->channel }}</td>
                                                <td><a href="https://twitch.tv/{{ $stream->channel }}" target="_blank">{{ $stream->channel }}</a></td>
                                                <td>{{ $stream->status === \App\Stream::STREAM_ON ? trans('l.stream.status_on') : trans('l.stream.status_off') }}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" href="{{ route('streams.edit', $stream->id) }}">Edit</a> |
                                                    <a class="btn btn-danger btn-sm" href="{{ route('streams.destroy', $stream->id) }}">Delete</a> |
                                                    <a class="btn btn-info btn-sm" href="{{ route('streams.status', $stream->id) }}">{{ $stream->status === \App\Stream::STREAM_ON ? trans('l.stream.status_off') : trans('l.stream.status_on') }}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                @else
                                    <div class="row">
                                        <div class="col text-center">
                                            <a class="btn btn-primary btn-lg" href="{{ route('streams.create') }}">Create stream</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            {{ $streams->render('layouts.paginate') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
@section('admin-footer')
    @include('admin.layouts.admin-footer')
@endsection


    
