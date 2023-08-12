@php
$sidebar_details = [];
$sidebar_details[] = ['Anamnesis', '_anamnesis'];
$sidebar_details[] = ['Keluhan Tambahan', '_keluhan_tambahan'];
$sidebar_details[] = ['Faktor Resiko dan Penyakit Penyerta', '_faktor_resiko'];
$sidebar_details[] = ['Riwayat Pengobatan Dalam 1 bulan terakhir', '_riwayat_pengobatan_1_bln'];
$sidebar_details[] = ['Riwayat Pengobatan LUTS sebelumnya', '_riwayat_pengobatan_luts'];
$sidebar_details[] = ['Riwayat operasi / endoskopi urologi', '_riwayat_operasi_urologi'];
@endphp

@foreach($sidebar_details as $sidebar_detail)
<a
    data-active-module-action_pasien___detail_oab{{ $sidebar_detail[1] }}="1"
    href="{{ route('pasien.detail_oab'.$sidebar_detail[1], ID) }}"
    title="{{ $sidebar_detail[0] }}"
>{{ $sidebar_detail[0] }}</a>
@endforeach
