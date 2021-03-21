@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edição de {{ $details['title']['single'] }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <form class="form-horizontal" action="{{ route($details['route'].'.update', $data['id']) }}" method="post">
                                {!! method_field('PUT') !!}
                                {!! csrf_field() !!}
                                <div class="card-body pt-2 pb-0">
                                    <div class="form-group">
                                        <label class="control-label" for="name">Recrutador</label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ isset($data['name']) ? $data['name'] : old('name')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="email">E-mail</label>
                                        <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ isset($data['email']) ? $data['email'] : old('email')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password">Senha</label>
                                        <input type="password" class="form-control form-control-sm" id="password" name="password" value="12345678" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="id_company">Empresa</label>
                                        <select class="form-control form-control-sm" id="id_company" name="id_company" required>
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
