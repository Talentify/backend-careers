<!-- login Section-->
<section class="page-section vh-100 d-flex align-items-center" id="login">
    <div class="container">
        <!-- login Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __('LOGIN') }}</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        <!-- login Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @include('components.error')
                <!-- To configure the login form email address, go to mail/login_me.php and update the email address in the PHP file on line 19.-->
                <form id="loginForm" method="POST" name="login" action="{{ route('login') }}">
                    @csrf
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="email">{{ __('Email') }}</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="{{ __('E-mail') }}" value="{{ env('ADM_EMAIL') }}" required="required" data-validation-required-message="{{ __('Please enter your username.') }}" />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="password">{{ __('Password') }}</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="{{ __('Password') }}"  value="{{ env('ADM_PASS') }}" required="required" data-validation-required-message="{{ __('Please enter your password.') }}" />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center mt-5">
                            <button type="submit" class="btn btn-primary py-3 px-5">{{ __('LOGIN') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
