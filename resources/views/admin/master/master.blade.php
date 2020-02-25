<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/libs.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/style.css')) }}"/>

    <link rel="icon" type="image/png" href="{{ url('backend/assets/images/favicon.png') }}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Talentify - Backend Carrers</title>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"></div>

<div class="dash">
    <aside class="dash_sidebar">
        <article class="dash_sidebar_user">
            <img class="dash_sidebar_user_thumb" src="{{ url(asset('backend/assets/images/avatar.jpg')) }}" alt="" title=""/>

            <h1 class="dash_sidebar_user_name">
                <a href="">Área Administrativa</a>
            </h1>
        </article>

        <ul class="dash_sidebar_nav">
            <li class="dash_sidebar_nav_item {{ isActive('admin.dashboard') }}">
                <a class="icon-tachometer" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="dash_sidebar_nav_item" {{ isActive('admin.jobs') }}><a class="icon-file-text" href="{{ route('admin.jobs.index') }}">Vagas</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class="{{ isActive('admin.jobs.index') }}>"><a href="{{ route('admin.jobs.index') }}">Ver Todas</a></li>
                    <li class="{{ isActive('admin.jobs.create') }}"><a href="{{ route('admin.jobs.create') }}">Cadastrar Vaga</a></li>
                </ul>
            </li>
        </ul>

    </aside>

    <section class="dash_content">

        <div class="dash_userbar">
            <div class="dash_userbar_box">
                <div class="dash_userbar_box_content">
                    <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                    <img src="{{ url('backend/assets/images/talentify_logo.png') }}">
                    <div class="dash_userbar_box_bar no_mobile">
                        <a class="text-red icon-sign-out" href="{{ route('login.logout') }}">Sair</a>
                    </div>
                </div>
            </div>
        </div>
        @include('base.flash-message')

        @yield('content')
        <div class="dash_content_box">
        </div>
    </section>
</div>

<script src="{{ url(mix('backend/assets/js/jquery.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/libs.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/scripts.js')) }}"></script>

@hasSection('js')
    @yield('js')
@endif
</body>
</html>
