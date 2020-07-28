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
                        <div class="card-header">Edit Banner #{{ $banner->id }}</div>

                        <div class="card-body">
                            <form action="{{ route('banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($banner->image_dark))
                                    <img src="{{ asset($banner->path_to_image_dark()) }}" alt="..." class="img-thumbnail rounded border" width="250px">
                                @endif
                                <div class="form-group">
                                    <label for="imageInput">Image for dark theme</label>
                                    <input type="file" name="image_dark" class="form-control-file" value="{{ $banner->image_dark ?? old('image_dark') }}" id="imageInput">
                                    @error('image_dark')<small id="imageInput" class="form-text text-muted">{{ $message }}</small>@enderror
                                </div>
                                @if (isset($banner->image_white))
                                    <img src="{{ asset($banner->path_to_image_white()) }}" alt="..." class="img-thumbnail rounded border" width="250px">
                                @endif
                                <div class="form-group">
                                    <label for="imageInput">Image for white theme</label>
                                    <input type="file" name="image_white" class="form-control-file" value="{{ $banner->image_white ?? old('image_white') }}" id="imageInput2">
                                    @error('image_white')<small id="imageInput2" class="form-text text-muted">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="titleInput">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $banner->title ?? old('title') }}" id="titleInput">
                                    @error('title')<small id="titleInput" class="form-text text-muted">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="linkInput">Link</label>
                                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ $banner->link ?? old('link') }}" id="linkInput">
                                    @error('link')<small id="linkInput" class="form-text text-muted">{{ $message }}</small>@enderror
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



