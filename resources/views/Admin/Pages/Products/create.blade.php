@extends('Admin.Layouts.app')

@section('title', 'Cadastrar novo produto')

@section('content')
    <h1>Cadastro de produto</h1>

    @if ($errors->any())
        <ul>
            @foreach ( $errors->all() as $erro )
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif
    <form  action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Nome">
        <input type="text" name="description" placeholder="Descrição">
        <input type="email" name="email" placeholder="E-mail">
        <p><input type="file" name="photo"></p>
        <button type="submit" >Enviar</button>
    </form>
@endsection