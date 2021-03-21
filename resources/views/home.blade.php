@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <form class="form-horizontal" action="{{ route($details['route'].'.seeVacancies') }}" method="post">
                {!! csrf_field() !!}
                <div class="input-group rounded mb-5">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                           aria-describedby="search-addon" name="search" />
                    <button type="submit" class="input-group-text border-0" id="search-addon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </form>

            <div class="row">

                @foreach($datas as $data)
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">(#{{ str_pad($data['id'], 5, "0", STR_PAD_LEFT) }}) {{ $data['title'] }}</h5>
                                <p class="card-text text-justify">{{ $data['description'] }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Empresa: {{ $data['company'] }}</li>
                                <li class="list-group-item">R$ {{ number_format($data['salary'], 0, ",", ".") }} / Mês</li>
                                <li class="list-group-item">{{ $data['address'] }}</li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Candidatar-se</a>
                                <a href="#" class="card-link">Mais...</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
