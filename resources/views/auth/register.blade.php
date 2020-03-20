@extends('layouts.clean')

@section('content')
<div class="row">
    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-7">
    <div class="p-5">
        <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Criar Nova Conta!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" placeholder="Nome" name="name" id="name">
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" placeholder="Sobrenome">
                </div>
            </div>
            <div class="form-group">
                <input type="email" class="form-control form-control-user" placeholder="Email" name="email" id="email">
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input class="form-control form-control-user" placeholder="Senha" type="password" name="password" id="password" required>
                </div>
                <div class="col-sm-6">
                    <input class="form-control form-control-user" placeholder="Repita a Senha" type="password" name="password_confirmation" id="password-confirm" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Registrar
            </button>
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">Já tem conta? Entre!</a>
        </div>
    </div>
    </div>
</div>
@endsection
