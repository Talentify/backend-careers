@extends('layout')

@section('cabecalho')
    <h1> Vaga {{$vagas->titulo}}</h1>
@endsection

@section('conteudo')
    <p>Vaga:    {{ $vagas->descricao }}</p>
    <p>Status:  {{ $vagas->situacao }}</p>
    <p>Salario: {{ $vagas->salario }}</p>
@endsection