@extends('Admin.Layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <h1>Edição de produto {{$id}}</h1>
    <form  action="{{ route('produto.update', $id ) }}" method="post">
        @method('PUT')
        @csrf
        <input type="text" name="name" placeholder="Nome">
        <input type="text" name="description" placeholder="Descrição">
        <button type="submit" >Enviar</button>
    </form>
    {{-- comentario blade Ctrl+k+c --}}
@endsection