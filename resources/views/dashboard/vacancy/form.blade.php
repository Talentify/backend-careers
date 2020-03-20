@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Lista de Vagas</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                Vagas - Formulário
                </div>
                <div class="card-body">
                    <!-- Alert Error -->
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Error!</strong> Verifique se todos os campos estão preenchidos corretamente.
                        <button type="button" class="close" onclick="$('.alert').hide();">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- End Alert Error -->
                    <form class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Entre com o Título" required>
                            <div class="invalid-feedback">
                                Por favor informe um Título.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Entre com a descrição" required>
                            <div class="invalid-feedback">
                                Por favor informe uma Descrição.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status"
                                placeholder="Entre com o Status" required>
                            <div class="invalid-feedback">
                                Por favor informe um Status.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="workplace">Local de Trabalho</label>
                            <input type="text" class="form-control" id="workplace" name="workplace"
                                placeholder="Entre com o Local de Trabalho">
                            <div class="invalid-feedback">
                                Por favor informe um Local de Trabalho.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="salary">Valor</label>
                            <input type="text" class="form-control" id="salary" name="salary"
                                placeholder="Entre com o valor">
                            <div class="invalid-feedback">
                                Por favor informe um valor.
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="/vacancy/list" class="btn btn-outline-dark btn-sm">
                        <span data-toggle="tooltip" data-placement="top" title="Novo registro">
                            <i class="far fa-hand-point-left"></i>
                            <span class="d-none d-sm-inline">Voltar</span>
                        </span>
                    </a>
                    <button type="button" id="submit" class="btn btn-outline-primary btn-sm">
                        <span data-toggle="tooltip" data-placement="top" title="Novo registro">
                            <i class="far fa-save"></i>
                            <span class="d-none d-sm-inline">Salvar</span>
                        </span>
                    </button>
                </div>
            </div>
            <!-- End Form -->
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="/js/common.js"></script>
<script src="/js/vacancies/form.js"></script>
@endsection
