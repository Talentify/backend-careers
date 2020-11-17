@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>
            @lang('Vagas divulgadas')
        </h1>
        <div>
            <a href="{{ route('vacancies.create') }}" class="btn btn-primary">
                @lang('Divulgar vaga')
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (!$vacancies->isEmpty())
            {{-- Vagas --}}
        @else
            @lang('Você não tem vagas divulgadas')
        @endif
    </div>
</div>
@endsection
