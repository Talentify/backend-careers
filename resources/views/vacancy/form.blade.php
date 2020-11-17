@csrf
<div class="card-body">
    <div class="form-group">
        <label for="title">
            @lang('Título da vaga')
            <span class="required-signal">*</span>
        </label>
        <input value="{{ old('title', $vacancy->title ?? '') }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
        @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">
            @lang('Descrição da vaga')
            <span class="required-signal">*</span>
        </label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description', $vacancy->description ?? '') }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="status">
            @lang('Status da vaga')
            <span class="required-signal">*</span>
        </label>
        <div class="@error('status') is-invalid @enderror">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status-open" value="open">
                <label class="form-check-label" for="status-open">
                    @lang('Aberta')
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status-closed" value="closed">
                <label class="form-check-label" for="status-closed">
                    @lang('Fechada')
                </label>
            </div>
        </div>
        @error('status')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="workplace">
            @lang('Endereço')
        </label>
        <input value="{{ old('workplace', $vacancy->workplace ?? '') }}" type="text" class="form-control @error('workplace') is-invalid @enderror" id="workplace" name="workplace">
        @error('workplace')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="salary">
            @lang('Salário')
        </label>
        <input value="{{ old('salary', $vacancy->salary ?? '') }}" type="number" placeholder="$" step='0.01' class="form-control @error('salary') is-invalid @enderror" id="salary" name="workplace">
        @error('salary')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
