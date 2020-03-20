@extends('layouts.clean')

@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                    <div class="row">
                      <div class="col-lg-6"> <a class="btn btn-primary" href="/login">Entrar</a> </div>
                      <div class="col-lg-6"> <a class="btn btn-secondary" href="/register">Cadastrar-se</a> </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-12">
                              <div class="card">
                                  <div class="card-header">
                                      Vagas
                                  </div>
                                  <div class="card-body">
                                      <table class="table">
                                          <thead>
                                              <tr>
                                                  <td>Título</td>
                                                  <td>Descrição</td>
                                                  <td>Salário</td>
                                              </tr>
                                          </thead>
                                          <tbody></tbody>
                                      </table>
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
@section('scripts')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/home/read.js"></script>
@endsection