@extends('base.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Dashboard</h2>
            </header>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="users radius">
                        <h4 class="icon-file-text">Vagas</h4>
                        <p><b>Ativas:</b> {{ $actived }}</p>
                        <p><b>Inativas:</b> {{ $inactived }}</p>
                    </article>
                </section>
            </div>
        </section>
    </div>
@endsection
