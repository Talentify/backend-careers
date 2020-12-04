<!-- jobs Section-->
<section class="page-section jobs" id="jobs">
    <div class="container">
        <!-- jobs Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __('JOBS') }}</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- jobs Grid Items-->
        <div class="row justify-content-center">
            @foreach (\App\Models\Jobs::getJobs($page) as $job)
            <div class="col-md-6 col-lg-4 mb-5 d-flex align-items-stretch">
                <div class="jobs-item mx-auto text-center p-3 w-100 {{ ($job->status === \App\Models\JobsStatus::DISABLE) ? 'bg-danger' : 'bg-secondary' }} text-white">
                    <div class="jobs-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="jobs-item-caption-content text-center text-white"><i class="fas fa-check-circle fa-3x"></i></div>
                    </div>
                    <h3 class="text-primary pb-2">{{ $job->title }}</h3>
                    <p>{{ $job->description }}</p>
                    <p class="font-weight-bold"><i class="fa fa-dollar-sign" aria-hidden="true"></i> {{ $job->salary }}</p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $job->workplace }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col text-center mb-5">
                @if (isset($page) && $page > 0)
                    <a href="{{ url($route . '/' . ($page - 1)) }}" type="button" class="btn btn-outline-primary py-3 px-5">{{ __('BACK JOBS') }}</a>
                @endif
                <a href="{{ url($route . '/' . (@$page + 1)) }}" type="button" class="btn btn-primary py-3 px-5">{{ __('NEXT JOBS') }}</a>
            </div>
        </div>
    </div>
</section>
