@extends('layouts.admin')

@section('content')
    <div class="form-title">
        <h1>{{$title}}</h1>
    </div>
    <hr>

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @isset($message)
        <div class="errorMessage">
            <span class="alert {{isset($error) && $error === true ? 'alert-danger' : 'alert-success'}}">{{$errorMessage}}</span>
        </div>
    @endisset

    <div class="col-md-12">
        @if(isset($opportunity))
            <form method="POST" action="{{ route('admin.opportunity.postEdit', $opportunity->id) }}">
        @else
            <form method="POST" action="{{  route('admin.opportunity.postCreate') }}">
        @endif
            @csrf

            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-4">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{isset($opportunity) ? $opportunity->title : ''}}" required autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                <div class="col-md-4">
                    <textarea rows="6" id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>@isset($opportunity){{$opportunity->description}}@endisset</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-md-2 col-form-label text-md-right">{{ __('Status') }}</label>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="radio">
                            <label><input type="radio" name="status" class="@error('status') is-invalid @enderror" name="status-active" value="active" {{isset($opportunity) && $opportunity->status === 'active' ? "checked" : ""}}>Active</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="status" class="@error('status') is-invalid @enderror" name="status-paused" value="paused" {{isset($opportunity) && $opportunity->status === 'paused' ? "checked" : ""}}>Paused</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="status" class="@error('status') is-invalid @enderror" name="status-inactive" value="inactive" {{isset($opportunity) && $opportunity->status === 'inactive' ? "checked" : ""}}>Inactive</label>
                        </div>
                    </div>

                    @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="workplace" class="col-md-2 col-form-label text-md-right">{{ __('Workplace') }}</label>

                <div class="col-md-4">
                    <input id="workplace" type="text" class="form-control @error('workplace') is-invalid @enderror" name="workplace" value="{{isset($opportunity) ? $opportunity->workplace : ''}}">

                    @error('workplace')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="salary" class="col-md-2 col-form-label text-md-right">{{ __('Salary ($/year)') }}</label>

                <div class="col-md-3">
                    <input id="salary" class="form-control money @error('salary') is-invalid @enderror" name="salary" value="{{isset($opportunity) ? $opportunity->salary : ''}}">

                    @error('workplace')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="container">
                <div class="form-group row">
                    <div class="col-md-12 text-center row">
                        <div class="col-md-6">
                            <a href="{{route('admin.home')}}" class="btn btn-secondary float-left">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary float-right">
                                {{ __('Save opportunity') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="//code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="{{asset('js/simple.money.format.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.money').simpleMoneyFormat();
        });
    </script>
@endsection
