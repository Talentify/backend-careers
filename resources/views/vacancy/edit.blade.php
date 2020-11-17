@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between">
    <h1>
        @lang('Editar vaga')
    </h1>
    <div>
        <a href="{{ route('vacancies.index') }}" class="btn btn-secondary">
            @lang('Voltar')
        </a>
    </div>
</div>
<div class="card shadow-sm">
    <form action="{{ route('vacancies.update', $vacancy) }}" method="POST">
        @method('PUT')
        @include('vacancy.form')
        <div class="card-footer">
            <button type="submit" class="btn button-enviar btn-success">
                @lang('Atualizar vaga')
            </button>
        </div>
    </form>
</div>
@endsection
