@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between">
    <h1>
        @lang('Vagas divulgadas')
    </h1>
    <div>
        <a href="{{ route('home') }}" class="btn btn-link">
            @lang('Vagas abertas')
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
                        @lang('Status')
                    </th>
                    <th scope="col">
                        @lang('Ações')
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
                            {{ $vacancy->status === 'opened' ? __('Aberto') : __('Fechado') }}
                        </td>
                        <td>
                            <form onsubmit="return confirm('Tem certeza que deseja apagar a vaga?')" action="{{ route('vacancies.destroy', $vacancy) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    @lang('Apagar')
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @lang('Você não tem vagas divulgadas')
    @endif
</div>
@endsection
