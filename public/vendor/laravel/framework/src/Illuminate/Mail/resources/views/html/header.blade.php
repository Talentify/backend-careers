<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Talentify')
<img src="{{asset("img/logo.png")}}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
