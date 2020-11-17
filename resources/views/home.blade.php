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
                            @lang('Status')
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
                                {{ $vacancy->status === 'open' ? __('Aberto') : __('Fechado') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @lang('Você não tem vagas divulgadas')
        @endif
    </div>
</div>
@endsection
