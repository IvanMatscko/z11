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
                        <div class="card-header">Ban source</div>

                        <div class="card-body">
                            <form action="{{ route('news.admin.store-ban') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Source (channel id) <- Without '@' symbol</label>
                                    <input required id="name" type="text" name="name" placeholder="Without '@' symbol" class="form-control" value="{{ old('source') }}">
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



