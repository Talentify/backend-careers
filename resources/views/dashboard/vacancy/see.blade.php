@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Lista de Vagas</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Vagas - Visualização
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    <a href="/vacancy/list" class="btn btn-outline-dark btn-sm"> <span data-toggle="tooltip" data-placement="top" title="Novo registro"> <i class="far fa-hand-point-left"></i> <span class="d-none d-sm-inline">Voltar</span> </span>
                    </a>
                    <a href="edit" class="btn btn-outline-warning btn-sm"> <span data-toggle="tooltip" data-placement="top" title="Novo registro"> <i class="far fa-edit"></i> <span class="d-none d-sm-inline">Editar</span> </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/common.js"></script>
<script src="/js/vacancies/see.js"></script>
@endsection
