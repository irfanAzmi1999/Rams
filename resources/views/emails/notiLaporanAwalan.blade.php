@component('mail::message')
{{-- Greeting --}}
# Perhatian!

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach
<p style="text-align: center;font-weight: bold;"> {{$tableHeader}}</p>
@php
$i = 0;
@endphp
@component('mail::table')
| Bil | No Laporan | 
| :--: | :----:| 
@foreach($accs as $no_laporan)
| {{++$i}} | {{$no_laporan}} |
@endforeach
@endcomponent
{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Sekian,<br>Pentadbir Sistem
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
Sekiranya anda menghadapi masalah mengklik butang "{{ $actionText }}", <i>copy</i> dan <i>paste</i> URL di bawah ke dalam pelayar web anda : <br>[{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
