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
                                    <label class="control-label" for="title">Título</label>
                                    <input disabled type="text" class="form-control form-control-sm" id="title" name="title" value="{{ isset($data['title']) ? $data['title'] : old('title')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Descrição</label>
                                    <textarea disabled class="form-control" id="description" name="description" rows="3">{{ isset($data['description']) ? $data['description'] : old('description')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="status">Status</label>
                                    <select disabled class="form-control form-control-sm" id="status" name="status" required>
                                        <option value="1">Ativo</option>
                                        <option value="0">Desativado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="address">Endereço</label>
                                    <input disabled type="text" class="form-control form-control-sm" id="address" name="address" value="{{ isset($data['address']) ? $data['address'] : old('address')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="salary">Salário</label>
                                    <input disabled type="number" class="form-control form-control-sm" id="salary" name="salary" value="{{ isset($data['salary']) ? $data['salary'] : old('salary')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="company">Empresa</label>
                                    <input disabled type="text" class="form-control form-control-sm" id="company" name="company" value="{{ isset($data['company']) ? $data['company'] : old('company')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="recruiter">Recrutador</label>
                                    <input disabled type="text" class="form-control form-control-sm" id="recruiter" name="recruiter" value="{{ Auth::user()->name }}">
                                </div>
                                <input type="hidden" name="id_recruiter" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <a class="btn btn-sm btn-warning" href="{{ route($details['route'].".edit", $data['id']) }}">Editar</a>
                                    <a href="{{ route($details['route'].'.myvacancies') }}" class="btn btn-sm btn-default = btn-sm">Cancelar</a>
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
