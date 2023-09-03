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
if (isset($sistem_skor)) {
  if (isset($sistem_skor->c_oabss) && $sistem_skor->c_oabss) {
    $sidebar_details[] = ['OABSS', '_kuesioner_oabss'];
  }
  if (isset($sistem_skor->c_qol) && $sistem_skor->c_qol) {
    $sidebar_details[] = ['QOL', '_kuesioner_qol'];
  }
  if (isset($sistem_skor->c_fsfi) && $sistem_skor->c_fsfi) {
    $sidebar_details[] = ['FSFI', '_kuesioner_fsfi'];
  }
  if (isset($sistem_skor->c_iief) && $sistem_skor->c_iief) {
    $sidebar_details[] = ['IIEF', '_kuesioner_iief'];
  }
  if (isset($sistem_skor->c_ehs) && $sistem_skor->c_ehs) {
    $sidebar_details[] = ['EHS', '_kuesioner_ehs'];
  }
  if (isset($sistem_skor->c_bladder_diary) && $sistem_skor->c_bladder_diary) {
    $sidebar_details[] = ['Bladder Diary', '_kuesioner_bladder_diary'];
  }
}
$sidebar_details[] = ['Pemeriksaan fisik', '_pemeriksaan_fisik'];
$sidebar_details[] = ['Pemeriksaan Laboratorium', '_pemeriksaan_laboratorium'];
$sidebar_details[] = ['Penunjang - Uroflowmetri', '_penunjang_uroflowmetri'];
$sidebar_details[] = ['Penunjang - Urodinamik', '_penunjang_urodinamik'];
$sidebar_details[] = ['Pemeriksaan Imaging', '_pemeriksaan_imaging'];
$sidebar_details[] = ['Penunjang', '_penunjang'];
$sidebar_details[] = ['Terapi', '_terapi'];
if (isset($terapi)) {
  if (isset($terapi->c_modifikasi_gaya_hidup) && $terapi->c_modifikasi_gaya_hidup) {
    $sidebar_details[] = ['Terapi Modifikasi Gaya Hidup', '_terapi_modifikasi_gaya_hidup'];
  }
  if (isset($terapi->c_rehabilitasi) && $terapi->c_rehabilitasi) {
    $sidebar_details[] = ['Terapi Rehabilitasi', '_terapi_rehabilitasi'];
  }
}
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
