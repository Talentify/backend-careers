@extends('layouts.clean')

@section('content')
<div class="row">
    <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
    <div class="col-lg-6">
    <div class="p-5">
        <div class="text-center">
        <h1 class="h4 text-gray-900 mb-2">Esqueceu sua senha?</h1>
        <p class="mb-4">Entendemos, as coisas acontecem. Basta digitar seu endereço de e-mail abaixo e enviaremos um link para redefinir sua senha!</p>
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form class="user" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input class="form-control form-control-user" placeholder="Email" type="email" name="email" id="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Redefinir senha
        </button>
        </form>
        <hr>
        <div class="text-center">
        <a class="small" href="{{ route('register') }}">Criar nova Conta!</a>
        </div>
        <div class="text-center">
        <a class="small" href="{{ route('login') }}">Já tem conta? Entre!</a>
        </div>
    </div>
    </div>
</div>
@endsection
