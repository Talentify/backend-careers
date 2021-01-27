@extends('layout')

@section('content')

<link href="{{ asset('assets/css/admin/signin.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('assets/js/admin/signin.js') }}"></script>

<main class="form-signin text-center">
    <form method="POST" action="./auth" id="signin-form">
        <img class="mb-4" src="https://www.talentify.io/hubfs/Talentify%20logo-4.png" alt="Logo">
        <h1 class="h3 mb-3 fw-normal">Acessar admin</h1>
        <label for="inputEmail" class="visually-hidden">E-mail</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="visually-hidden">Senha</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Acessar</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
    </form>
</main>
@stop