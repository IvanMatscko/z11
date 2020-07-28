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
                        <div class="card-header">{{ isset($source) ? 'Edit' : 'Create' }} source</div>

                        <div class="card-body">
                            <form action="{{ route('news.store') }}" method="POST">
                                @csrf
                                @isset($source)
                                    <input type="hidden" name="source_id" value="{{ $source->id }}">
                                @endisset

                                <div class="form-group">
                                    <label for="source">Source (channel id) <- Without '@' symbol</label>
                                    <input required id="source" type="text" name="source" placeholder="Without '@' symbol" class="form-control" value="{{ $source->source ?? old('source') }}">
                                </div>

                                <div class="form-group">
                                    <label for="name">Source name</label>
                                    <input required id="name" type="text" name="name" placeholder="Source name" class="form-control" value="{{ $source->name ?? old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="type">Application</label>
                                    <select class="form-control" required name="type" id="type">
                                        <option selected value="tg">Telegram</option>
                                        <option selected value="tw">Twitter</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="locale">Language</label>
                                    <select class="form-control" required name="locale" id="locale">
                                        <option value="ru" {{ isset ($source) && $source->locale == 'ru' ? 'selected' : '' }}>Russian</option>
                                        <option value="en" {{ isset ($source) && $source->locale == 'en' ? 'selected' : '' }}>English</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="game">Game</label>
                                    <select class="form-control" required name="game" id="game">
                                        <option value="dota" {{ isset ($source) && $source->game == 'dota' ? 'selected' : '' }}>Dota 2</option>
                                        <option value="cs" {{ isset ($source) && $source->game == 'cs' ? 'selected' : '' }}>CS:GO</option>
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



