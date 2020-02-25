<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/libs.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/style.css')) }}"/>

    @hasSection('js')
        @yield('js')
    @endif

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
    <section class="dash_content">
        <div class="dash_userbar">
            <div class="dash_userbar_box">
                <div class="dash_userbar_box_content">
                    <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                    <img src="{{ url('backend/assets/images/talentify_logo.png') }}">

                    @if(isset($user_logged) && $user_logged == 0)
                        <div class="dash_userbar_box_bar no_mobile">
                            <a class="text-red icon-user" href="{{ route('user.register') }}">Cadastre-se</a>
                            <a class="text-red icon-sign-in" href="{{ route('login.check') }}">Logar</a>
                        </div>
                    @else
                        <div class="dash_userbar_box_bar no_mobile">
                            <a class="text-red icon-sign-out" href="{{ route('login.logout') }}">Sair</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('base.flash-message')

        <div class="dash_content_box">
            @yield('content')
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
