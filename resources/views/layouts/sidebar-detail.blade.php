@php
$sidebar_details = [];
$sidebar_details[] = ['Identitas', ''];
$sidebar_details[] = ['Pilihan Penyakit', '_pilihan_penyakit'];
@endphp

@foreach($sidebar_details as $sidebar_detail)
<a
    data-active-module-action_pasien___detail{{ $sidebar_detail[1] }}="1"
    href="{{ route('pasien.detail'.$sidebar_detail[1], ID) }}"
    title="{{ $sidebar_detail[0] }}"
>{{ $sidebar_detail[0] }}</a>
@endforeach
