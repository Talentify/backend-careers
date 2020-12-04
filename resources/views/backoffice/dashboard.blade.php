@extends('themes.indigo')
@section('body')
    @include('components.navbar')
    <div class="masterhead-padding">
        <div class="container">
            @include('components.success')
        </div>
        @include('components.jobs')
    </div>
    @include('components.copyright')
@endsection
