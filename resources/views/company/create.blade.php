@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Criação de {{ $details['title']['single'] }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <form class="form-horizontal" action="{{ route($details['route'].'.store') }}" method="post">
                                {!! csrf_field() !!}
                                <div class="card-body pt-2 pb-0">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Nome da Empresa</label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ isset($data->name) ? $data->name : old('name')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                        <a href="{{ route($details['route'].'.index') }}" class="btn btn-default = btn-sm">Cancelar</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
