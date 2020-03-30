@extends('layouts.app')

@section('content')
    <div class="top-center position-ref full-height">
        <div class="content">

            <div class="text-center">
                <img src="{{asset("img/logotype.png")}}"/>
            </div>
            <div class="subtitle-center">
                Recruitment Marketing on Autopilot
            </div>

            <div class="bg-light shadow-lg main-home-content-division">
                <div class="col-md-12">
                    <form action="{{ route('search') }}" method="POST">
                        @csrf
                        <div class="form-group input-icons">
                            <span class="fa fa-search"></span>
                            <input type="text" class="form-control main-home-search-input" name="query" placeholder="Search for opportunities">
                            <input type="submit" class="btn btn-md btn-primary pull-right" value="Search" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container content search-body">
            <div class="">
                <b>Showing {{ $searchResults->count() }} opportunities
                    @if( request('query') )
                        for "{{ request('query') }}"
                    @endif
                </b>
            </div>

            <div class="container content search-content row">
                @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                    @foreach($modelSearchResults as $searchResult)
                        <div class="col-md-4 float-left opportunity-card-content">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $searchResult->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">${{ $searchResult->searchable->salary }}/year</h6>
                                    <p class="card-text opportunity-card-body">{{ $searchResult->searchable->description }}</p>
                                    <a href="{{ $searchResult->url }}" class="card-link btn btn-md btn-primary">View job</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="container content opportunities-pagination row">
            <div class="col-md-12">
                {{$searchResults->render()}}
            </div>
        </div>
    </div>
@endsection
