@extends('layout')

@section('content')
<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>Talentify Dev Job</strong>
            </a>
            <a href="./admin/login" class="navbar-toggler text-decoration-none" type="button">
                <span class="text-decoration-none">Admin Sign-in</span>
            </a>
        </div>
    </div>
</header>

<main>
    <section class="py-3 text-center container">
        <div class="row pt-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Talentify Test</h1>
                <p class="lead text-muted">Page build as a test to Talentify PHP Developer job.</p>
                <p class="lead text-muted">The list of open jobs is shown below</p>
                <p class="lead text-muted">Página construída para o teste para vaga de Desenvolvedor na Talentify.</p>
                <p class="lead text-muted">A lista das vagas abertas encontra-se logo abaixo</p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($jobs as $job)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">{{$job['title']}}</h3>
                            <p class="card-text">{{ \Str::limit($job['description'], 150, '...')}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if(!empty($job['salary']))
                                <small class="text-muted">$ {{$job['salary']}}</small>
                                @else
                                <small class="text-muted">Salário não informado</small>
                                @endif

                                @if(!empty($job['workplace']))
                                <small class="text-muted">{{$job['workplace']}}</small>
                                @else
                                <small class="text-muted">Local não informado</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</main>
@stop