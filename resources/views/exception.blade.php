@extends('layouts.blank')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
        <!-- Styles -->
        <style>
            .full-height {
                min-height: calc(100vh - 178px);
                padding: 19px 15px;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                border-right: 2px solid;
                font-size: 26px;
                padding: 0 15px 0 15px;
                text-align: center;
            }

            .message {
                font-size: 18px;
                text-align: center;
            }
        </style>
        <div class="flex-center position-ref full-height">
            <div class="code">
                {{ $exception_code }}
            </div>

            <div class="message" style="padding: 10px;">
                {{ $exception_message }}
            </div>
        </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

