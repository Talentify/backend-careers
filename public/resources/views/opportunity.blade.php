@extends('layouts.app')

@section('content')
    <div class="container content position-ref full-height">
        <div class="col-md-12">
            <nav class="nav-opportunity navbar navbar-expand-lg navbar-light bg-light shadow nav-opportunity">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}"> All opportunities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#"> >> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">{{ $opportunity->title }}</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="title opportunity-title">
            {{$opportunity->title}}
        </div>

        <div class="col-md-12 opportunity-content">
            @if($opportunity->workplace && !empty($opportunity->workplace))
                <div class="col-md-4 row">
                    <label class="font-weight-bold">Workplace:&nbsp;</label><span>{{$opportunity->workplace}}</span>
                </div>
                <hr>
            @endif
            @if($opportunity->workplace && !empty($opportunity->salary))
                <div class="col-md-4 row">
                    <label class="font-weight-bold">Salary:&nbsp;</label><span>{{$opportunity->salary}} per year</span>
                </div>
                <hr>
            @endif
            <span class="subtitle-center">
                Job description
            </span>
            <div class="float-left opportunity-description">
                {{$opportunity->description}}
                <hr>
            </div>
            <div class="col-md-12 opportunity-content">
                <a href="{{route("apply", $opportunity->id)}}" class="card-link btn btn-md btn-primary">Apply</a>
            </div>
        </div>
    </div>
@endsection
