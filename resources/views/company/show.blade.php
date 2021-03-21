@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Visualização de {{ $details['title']['single'] }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <div class="card-body pt-2 pb-0">
                                <div class="form-group">
                                    <label class="control-label" for="name">Nome da Empresa</label>
                                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ isset($data['name']) ? $data['name'] : old('name')}}" disabled>
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-sm btn-warning" href="{{ route($details['route'].".edit", $data['id']) }}">Editar</a>
                                    <a href="{{ route($details['route'].'.index') }}" class="btn btn-sm btn-default = btn-sm">Cancelar</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
