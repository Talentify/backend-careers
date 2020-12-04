@if ($message = Session::get('success'))
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@endif
