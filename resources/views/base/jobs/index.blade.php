@extends('base.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Total de {{ $qtd }} Vagas Disponíveis</h2>
            </header>

            <div class="dash_content_app_box">
                @foreach($jobs as $job)
                    <section class="dash_content_app_box_stage">
                        <article class="users radius">
                            <h2 class="icon-star">{{ $job->title }}</h2><br>
                            <p><b>Descrição: </b>{{ substr($job->description,0,200) }}...</p>

                            @if($user_logged)
                                <p><b>Empresa: </b> {{ $job->company }}</p>
                                <p><b>Salário (USD): </b> {{ $job->salary > 0 ? $job->salary : 'Não Informado' }}</p>
                            @else
                                <p><b>Empresa: </b>Efetue o login para visualizar.</p>
                                <p><b>Salário (USD): </b>Efetue o login para visualizar.</p>
                            @endif

                            <p><b>Local:</b> {{ $job->workplace ? $job->workplace : 'Não Informado' }}</p>
                            <p><b>Disponível Desde:</b> {{ $job->created_at }}</p><br>

                            @if($user_logged && $user_admin == 0)
                            <a href="mailto:{{ $job->contact }}?Subject={{ $job->title }}" class="btn btn-green icon-pencil-square-o">Candidatar-se</a>
                            @endif
                        </article>
                    </section><br>
                @endforeach
            </div>
            <div>
                <nav aria-label="Page navigation example">
                    {{ $jobs->links("pagination::bootstrap-4") }}
                </nav>
            </div>
        </section>
    </div>
@endsection
