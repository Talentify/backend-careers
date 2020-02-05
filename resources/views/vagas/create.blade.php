@extends('layout')
@section('cabecalho')
    Adicionar vagas
@endsection

@section('conteudo')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('vagas.store') }}" method="post">
        @csrf
        <div class="p-2">
            <input type="text" class="form-control" name="titulo" placeholder="Título vaga">
            <input type="textArea" class="form-control" name="descricao" placeholder="Descrição">
            <input type="text" class="form-control mt-2" name="situacao" placeholder="Situação">
            <input type="numeric" class="form-control mt-2" name="salario" placeholder="Salario">
        </div>
        <button class="btn btn-primary ml-2" >Adicionar</button>
    </form>
@endsection