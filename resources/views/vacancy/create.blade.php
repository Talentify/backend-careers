@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>
            @lang('Divulgar vaga')
        </h1>
        <div>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                @lang('Voltar')
            </a>
        </div>
    </div>
    <div class="card shadow-sm">
        <form action="{{ route('vacancies.store') }}" method="POST">
            @include('vacancy.form')
            <div class="card-footer">
                <button type="submit" class="btn button-enviar btn-success">
                    @lang('Criar seleção')
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
