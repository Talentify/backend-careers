@extends('admin.layout')

@section('content')

<script type="text/javascript" src="{{ asset('assets/js/admin/jobs/list.js') }}"></script>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Vagas</h1>

        <a href="./jobs/add" class="btn text-white bg-success">
            + Adicionar
        </a>
    </div>

    @if(!empty($jobs))
    <table class="table table-responsive table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{$job['id']}}</td>
                <td>{{$job['title']}}</td>
                <td>
                    @if($job['status'] == 1)
                    <span class="badge bg-success">Aberta</span>
                    @else
                    <span class="badge bg-danger">Fechada</span>
                    @endif
                </td>
                <td>
                    <a href="./jobs/{{$job['id']}}"><span data-toggle="tooltip" title="Editar vaga" data-feather="edit-3"></span></a>
                    <a href="./jobs/{{$job['id']}}" class="job-delete"><span data-toggle="tooltip" title="Excluir vaga" data-feather="trash-2"></span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else
    <div class="alert alert-default">Não há nenhuma vaga cadastrada!</div>
    @endif

</main>
@stop