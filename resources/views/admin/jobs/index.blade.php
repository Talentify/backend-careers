@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Filtro</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="" class="text-orange">Vagas</a></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.jobs.create') }}" class="btn btn-orange icon-user ml-1">Cadastrar Vaga</a>
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Salário</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->company }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ substr($job->description,0,30) }}...</td>
                            <td>{{ ($job->status === 'active') ? 'Ativo' : 'Inativo' }}</td>
                            <td>USD {{ $job->salary }}</td>
                            <td><a href="{{ route('admin.jobs.edit', ['jobs' => $job->uuid]) }}">Editar</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
