@extends('layouts.clean')

@section('content')
<div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                </div>
                @error('password')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-user" placeholder="Email"  type="email" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <input  class="form-control form-control-user" placeholder="Senha" type="password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Lembrar</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Entrar
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="{{ route('register') }}">Criar nova Conta!</a>
                </div>
            </div>
        </div>
</div>
@endsection
