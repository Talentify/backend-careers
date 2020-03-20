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
                    Vagas
                </div>
                <div class="card-body">
                    <a href="/vacancy/create" class="btn btn-success"> Nova </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Título</td>
                                <td>Valor</td>
                                <td>Ações</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.vacancy.remove')
@endsection
@section('scripts')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/vacancies/read.js"></script>
@endsection
