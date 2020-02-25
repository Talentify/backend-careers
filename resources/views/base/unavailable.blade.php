@extends('base.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Página em manutenção, tente novamente mais tarde.</h2>
            </header>

            <div class="dash_content_app_box">
                @if (isset($debug))
                    <p>{{ $msg }}</p>
                @endif
            </div>
        </section>
    </div>
@endsection
