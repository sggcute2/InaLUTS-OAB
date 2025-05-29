@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}
  @php
    FORM::setup([
      'action' => $form_action
    ]);
    FORM::set_var($default);

    $temp = '
        Riwayat radiasi pelvis
        Riwayat kemoterapi
        Insitilasi Doxyrubicin
        Instilasi BCG
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );

            $a = [
                'Keganasan saluran kemih',
                'Keganasan saluran cerna',
                'Keganasan ginekologi',
                'Keganasan Lainnya',
            ];
            if (
                $field == 'insitilasi_doxyrubicin'
                || $field == 'instilasi_bcg'
            ) {
                $a = [];
            }
            $buffer = [];
            foreach($a as $va){
                $field_va = strtolower(
                    str_replace(array(' ', '-'), '_', $va)
                );

                $ext = '';
                if ($field_va == 'keganasan_lainnya') {
                    $ext .= '<div id="div_c_'.$field.'_keganasan_lainnya" class="indent1">';
                    $ext .= 'Keterangan : ';
                    $ext .= BS::textbox([
                                'name' => $field.'_keganasan_lainnya_keterangan',
                            ], false);
                    $ext .= '</div>';
                }

                $buffer[] = BS::checkbox([
                    'name' => 'c_'.$field.'_'.$field_va,
                    'caption' => $va,
                ], false).$ext;
            }

            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .implode('', $buffer)
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Functions
@php
$ns = '';
@endphp
function show_hide_c_riwayat_radiasi_pelvis_keganasan_lainnya(){
  const len = ($('input[name="{{ $ns }}c_riwayat_radiasi_pelvis_keganasan_lainnya"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_riwayat_radiasi_pelvis_keganasan_lainnya').show();
  } else {
    $('#div_c_riwayat_radiasi_pelvis_keganasan_lainnya').hide();
  }
}
function show_hide_c_riwayat_kemoterapi_keganasan_lainnya(){
  const len = ($('input[name="{{ $ns }}c_riwayat_kemoterapi_keganasan_lainnya"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_riwayat_kemoterapi_keganasan_lainnya').show();
  } else {
    $('#div_c_riwayat_kemoterapi_keganasan_lainnya').hide();
  }
}
function show_hide_c_insitilasi_doxyrubicin_keganasan_lainnya(){
  const len = ($('input[name="{{ $ns }}c_insitilasi_doxyrubicin_keganasan_lainnya"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_insitilasi_doxyrubicin_keganasan_lainnya').show();
  } else {
    $('#div_c_insitilasi_doxyrubicin_keganasan_lainnya').hide();
  }
}
function show_hide_c_instilasi_bcg_keganasan_lainnya(){
  const len = ($('input[name="{{ $ns }}c_instilasi_bcg_keganasan_lainnya"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_instilasi_bcg_keganasan_lainnya').show();
  } else {
    $('#div_c_instilasi_bcg_keganasan_lainnya').hide();
  }
}

// Behaviours
$('input[name="{{ $ns }}c_riwayat_radiasi_pelvis_keganasan_lainnya"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_riwayat_radiasi_pelvis_keganasan_lainnya = ifChanged");
  show_hide_c_riwayat_radiasi_pelvis_keganasan_lainnya();
});
$('input[name="{{ $ns }}c_riwayat_kemoterapi_keganasan_lainnya"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_riwayat_kemoterapi_keganasan_lainnya = ifChanged");
  show_hide_c_riwayat_kemoterapi_keganasan_lainnya();
});
$('input[name="{{ $ns }}c_insitilasi_doxyrubicin_keganasan_lainnya"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_insitilasi_doxyrubicin_keganasan_lainnya = ifChanged");
  show_hide_c_insitilasi_doxyrubicin_keganasan_lainnya();
});
$('input[name="{{ $ns }}c_instilasi_bcg_keganasan_lainnya"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_instilasi_bcg_keganasan_lainnya = ifChanged");
  show_hide_c_instilasi_bcg_keganasan_lainnya();
});

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
show_hide_c_riwayat_radiasi_pelvis_keganasan_lainnya();
show_hide_c_riwayat_kemoterapi_keganasan_lainnya();
show_hide_c_insitilasi_doxyrubicin_keganasan_lainnya();
show_hide_c_instilasi_bcg_keganasan_lainnya();
@endsection
