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
                        <div class="card-header">Stream create</div>

                        <div class="card-body">
                            <form action="{{ route('streams.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="imageInput">Channel</label>
                                    <input type="text" name="channel" class="form-control" value="{{ old('channel') }}" id="imageInput">
                                    @error('channel')<small id="imageInput" class="form-text text-muted">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="themeInput">Status</label>
                                    <select class="form-control" name="status" id="themeInput">
                                        @foreach($statuses as $key => $status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
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



