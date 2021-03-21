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
                                        <label class="control-label" for="title">Título</label>
                                        <input type="text" class="form-control form-control-sm" id="title" name="title" value="{{ isset($data['title']) ? $data['title'] : old('title')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="description">Descrição</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="status">Status</label>
                                        <select class="form-control form-control-sm" id="status" name="status" required>
                                            <option value="1">Ativo</option>
                                            <option value="0">Desativado</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="address">Endereço</label>
                                        <input type="text" class="form-control form-control-sm" id="address" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="salary">Salário</label>
                                        <input type="number" class="form-control form-control-sm" id="salary" name="salary" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="company">Empresa</label>
                                        <input type="text" class="form-control form-control-sm" id="company" name="company" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="recruiter">Recrutador</label>
                                        <input disabled type="text" class="form-control form-control-sm" id="recruiter" name="recruiter" value="{{ Auth::user()->name }}">
                                    </div>
                                    <input type="hidden" name="id_recruiter" value="{{ Auth::user()->id }}">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                                        <a href="{{ route($details['route'].'.myvacancies') }}" class="btn btn-default = btn-sm">Cancelar</a>
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
