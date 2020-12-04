@if ($message = Session::get('error'))
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@endif
