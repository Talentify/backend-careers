<!-- login Section-->
<section class="page-section" id="login">
    <div class="container">
        <!-- login Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">{{ __('ADD NEW JOB') }}</h2>
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
                <form id="loginForm" method="POST" name="login" action="{{ route('jobs') }}">
                    @csrf
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="title">{{ __('Title') }}</label>
                            <input class="form-control" id="title" name="title" type="text" placeholder="{{ __('Title') }}"  value="{{ old('title') }}" required="required" data-validation-required-message="{{ __('Please enter title.') }}" />
                            @error('title')
                            <p class="help-block text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control" id="description" rows="5" placeholder="{{ __('Description') }}"  name="description" required="required" data-validation-required-message="{{ __('Please enter description.') }}">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="help-block text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="workplace">{{ __('Workplace') }}</label>
                            <input class="form-control" id="workplace" name="workplace" type="text" value="{{ old('workspace') }}" placeholder="{{ __('Workplace') }}"  />
                            @error('workplace')
                            <p class="help-block text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="salary">{{ __('Salary') }}</label>
                            <input class="form-control" id="salary" name="salary" type="text" value="{{ old('salary') }}"  placeholder="{{ __('Salary') }}"  />
                            @error('salary')
                            <p class="help-block text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group control-checkbox">
                        <div class="form-group mb-0 pb-2 mt-5">
                            <input type="checkbox" class="mr-3" name="status" id="status" checked="checked" value="{{ \App\Models\JobsStatus::ENABLE }}">
                            <label for="status">{{ __('Status') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center mt-5">
                            <button type="submit" class="btn btn-primary py-3 px-5">{{ __('SAVE') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
