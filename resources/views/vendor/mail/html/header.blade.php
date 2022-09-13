<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
<div style="width: 100%">
    @if (trim($slot) === 'Laravel')
        <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
    @else
        <img src="{{asset('img/VTE-logo.png')}}" class="logo" alt="Asignación Directa Logo" style="width:100%">
        {{ $slot }}
    @endif
</a>
</td>
</tr>
