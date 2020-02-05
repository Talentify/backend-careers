@extends('Admin.Layouts.app')

@section('title', 'Gestão de Produtos')

@section('content')
    <h1>Exibindo os Produtos</h1>
    <a href="{{ route('produto.create') }}">Cadastrar</a>
    <hr>
        @component('Admin.Components.card')
            @slot('title')
                Titulo da pagina
            @endslot
                Um card de exemplo
        @endcomponent
    <hr>

    @include('Admin.Includes.alert', ['content' => 'Alerta de preço'])


    @foreach ( $produtos as $produto )
        <p class="@if($loop->last) last @endif">Produto : {{$produto}}</p>
    @endforeach

    <hr />

    @forelse ( $produtos as $produto )
        <p class="@if($loop->first) last @endif">Produto : {{$produto}}</p>
    @empty
        <p>Não existem Produtos cadastrados</p>
    @endforelse




    @if ( $teste == '' ){
        321
    @else
        987
    @endif
    {{$teste}}<br>
    @auth
        Esta altenticado
    @else
        Não esta autenticado
    @endauth

@endsection

@push('styles')
    <style>
        .last{
            background: #CCC;
        }
    </style>
@endpush

