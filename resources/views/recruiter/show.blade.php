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
                                <div class="card-body pt-2 pb-0">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Recrutador</label>
                                        <input type="text" disabled class="form-control form-control-sm" id="name" name="name" value="{{ isset($data['name']) ? $data['name'] : old('name')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="email">E-mail</label>
                                        <input type="email" disabled class="form-control form-control-sm" id="email" name="email" value="{{ isset($data['email']) ? $data['email'] : old('email')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password">Senha</label>
                                        <input type="password" disabled class="form-control form-control-sm" id="password" name="password" value="12345678" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="id_company">Empresa</label>
                                        <select disabled class="form-control form-control-sm" id="id_company" name="id_company" required>
                                            <option selected disabled>Selecione</option>
                                            @foreach($companies as $company)
                                                @if($company['id'] == $data['id_company'])
                                                    <option selected value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                                @else
                                                    <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
