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
                        <div class="card-header">{{ isset($word) ? 'Edit' : 'Create' }} word</div>

                        <div class="card-body">
                            <form action="{{ route('bwords.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="from">From</label>
                                    <input required id="from" type="text" name="from" class="form-control" value="{{ $word->from ?? old('from') }}">
                                </div>

                                <div class="form-group">
                                    <label for="to">To</label>
                                    <input required id="to" type="text" name="to" class="form-control" value="{{ $word->to ?? old('to') }}">
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



