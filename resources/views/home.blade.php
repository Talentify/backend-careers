@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>
            @lang('Vagas abertas')
        </h1>
        <div>
            <a href="{{ route('vacancies.index') }}" class="btn btn-link">
                @lang('Minhas vagas divulgadas')
            </a>
            <a href="{{ route('vacancies.create') }}" class="btn btn-primary">
                @lang('Divulgar vaga')
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        @if (!$vacancies->isEmpty())
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">
                            @lang('Título')
                        </th>
                        <th scope="col">
                            @lang('Descrição')
                        </th>
                        <th scope="col">
                            @lang('Salário')
                        </th>
                        <th scope="col">
                            @lang('Local')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vacancies as $vacancy)
                        <tr>
                            <td>
                                {{ $vacancy->title }}
                            </td>
                            <td>
                                {{ $vacancy->description }}
                            </td>
                            <td>
                                {{ !empty($vacancy->salary) ? "$ $vacancy->salary" : __('Não informado') }}
                            </td>
                            <td>
                                {{ !empty($vacancy->workplace) ? $vacancy->workplace : __('Não informado') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @lang('Não há vagas abertas')
        @endif
    </div>
</div>
@endsection
