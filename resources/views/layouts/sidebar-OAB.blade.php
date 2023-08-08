@php
$sidebar_details = [];
$sidebar_details[] = ['Anamnesis', '_anamnesis'];
@endphp

@foreach($sidebar_details as $sidebar_detail)
<a
    data-active-module-action_pasien___detail_oab{{ $sidebar_detail[1] }}="1"
    href="{{ route('pasien.detail_oab'.$sidebar_detail[1], ID) }}"
    title="{{ $sidebar_detail[0] }}"
>{{ $sidebar_detail[0] }}</a>
@endforeach
