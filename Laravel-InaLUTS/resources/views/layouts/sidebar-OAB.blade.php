@php
$sidebar_details = [];
$sidebar_details[] = ['Anamnesis', '_anamnesis'];
$sidebar_details[] = ['Keluhan Tambahan', '_keluhan_tambahan'];
$sidebar_details[] = ['Faktor Resiko dan Penyakit Penyerta', '_faktor_resiko'];
$sidebar_details[] = ['Riwayat Pengobatan Dalam 1 bulan terakhir', '_riwayat_pengobatan_1_bln'];
$sidebar_details[] = ['Riwayat Pengobatan LUTS sebelumnya', '_riwayat_pengobatan_luts'];
$sidebar_details[] = ['Riwayat operasi / endoskopi urologi', '_riwayat_operasi_urologi'];
$sidebar_details[] = ['Riwayat Operasi Non Urologi', '_riwayat_operasi_non_urologi'];
$sidebar_details[] = ['Riwayat Radiasi dan Kemoterapi', '_riwayat_radiasi'];
$sidebar_details[] = ['Sistem skor', '_sistem_skor'];
$sidebar_details[] = ['Pemeriksaan fisik', '_pemeriksaan_fisik'];
$sidebar_details[] = ['Pemeriksaan Laboratorium', '_pemeriksaan_laboratorium'];
$sidebar_details[] = ['Penunjang - Uroflowmetri', '_penunjang_uroflowmetri'];
$sidebar_details[] = ['Penunjang - Urodinamik', '_penunjang_urodinamik'];
$sidebar_details[] = ['Pemeriksaan Imaging', '_pemeriksaan_imaging'];
$sidebar_details[] = ['Penunjang', '_penunjang'];
@endphp

@foreach($sidebar_details as $sidebar_detail)
  @if($sidebar_detail[1]=='_pemeriksaan_laboratorium')
  <a
    data-active-module-action_pasien___list_oab{{ $sidebar_detail[1] }}="1"
    href="{{ route('pasien.list_oab'.$sidebar_detail[1], ID) }}"
    title="{{ $sidebar_detail[0] }}"
>{{ $sidebar_detail[0] }}</a>
  @else
<a
    data-active-module-action_pasien___detail_oab{{ $sidebar_detail[1] }}="1"
    href="{{ route('pasien.detail_oab'.$sidebar_detail[1], ID) }}"
    title="{{ $sidebar_detail[0] }}"
>{{ $sidebar_detail[0] }}</a>
  @endif
@endforeach
