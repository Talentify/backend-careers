<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <img src="{{ asset('images/logo.webp') }}" alt="{{ env('APP_NAME') }}" class="img-fluid"/>
        </a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @if(!Auth::user())
                    <li class="nav-item nmx-0 mx-lg-1"><a class="nav-link py-3 px-5 rounded btn btn-outline-light" href="{{ url('login') }}">{{ __('Login') }}</a></li>
                @else
                    <li class="nav-item nmx-0 mx-lg-1"><a class="nav-link p-3 rounded" href="{{ url('/dashboard') }}">{{ __('DASHBOARD') }}</a></li>
                    <li class="nav-item nmx-0 mx-lg-1"><a class="nav-link p-3 rounded" href="{{ url('/jobs/add') }}">{{ __('ADD NEW JOB') }}</a></li>
                    <li class="nav-item nmx-0 mx-lg-1"><a class="nav-link py-3 px-5 rounded btn btn-outline-light" href="{{ url('logout') }}">{{ __('Logout') }}</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
