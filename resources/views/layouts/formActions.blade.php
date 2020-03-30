<form action="{!! $deleteUrl !!}" method="POST" style="float: left; margin-right: 3px;">
    <input type="hidden" name="_method" value="delete">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
</form>
<a href="{!! $editUrl !!}" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
