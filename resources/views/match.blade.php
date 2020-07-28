@extends('layouts.blank')

@section('header')
    <script>
        var socket = io.connect('https://z11:3000');
    </script>
    @include('layouts.header')
@endsection

@section('content')
    <div class="content">

        <div class="side-container">
            <div class="side-online">
                <div class="menu-side-v2">
                    <ul> 
                        <li class="active link-last"><a href="#">{{ __('l.past') }}</a></li>  
                    </ul>
                </div>
                <div class="box-shadow">

                    @include('layouts.match_past')
                </div>
            </div>
            <div class="side-info">
                <div class="menu-side-v2">
                    <ul>
                        <li class="link-live active"><a href="#">{{ __('l.live') }}</a></li>  
                        <li class="link-future "><a href="#">{{ __('l.future') }}</a></li> 
                    </ul>
                </div>
                <ul class="match-list-info">
                    @include('layouts.match_live')

                    @include('layouts.match_future')
                </ul>
            </div>
        </div>  
        @include('layouts.match_display')

        @include('layouts.match_banners')
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
