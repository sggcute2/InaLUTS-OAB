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

    //Operasi area pelvik
    $temp = '
        Operasi kraniotomi
        Operasi tulang belakang
        Operasi di daerah pelvis
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

            if ($field == 'operasi_di_daerah_pelvis') {
                $a = [
                    'Histrektomi',
                    'Miomektomi',
                    'Kistektomi',
                    'Salfingo-ovorektomi',
                    'Operasi Ca colorektal',
                    'Operasi Digestif Lainnya',
                ];
                $buffer = [];
                foreach($a as $va){
                    $field_va = strtolower(
                        str_replace(array(' ', '-'), '_', $va)
                    );

                    $ext = '';
                    if ($field_va == 'operasi_digestif_lainnya') {
                        $ext .= '<div id="div_c_operasi_di_daerah_pelvis_operasi_digestif_lainnya" class="indent1">';
                        $ext .= 'Keterangan : ';
                        $ext .= BS::textbox([
                                    'name' => 'operasi_di_daerah_pelvis_operasi_digestif_lainnya_keterangan',
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
            } else {
                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .'</div>'
                );
                if (isset($default[$field]) && $default[$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$field}_ya').hide();");
                }
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
function show_hide_c_operasi_di_daerah_pelvis_operasi_digestif_lainnya(){
  const len = ($('input[name="{{ $ns }}c_operasi_di_daerah_pelvis_operasi_digestif_lainnya"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_operasi_di_daerah_pelvis_operasi_digestif_lainnya').show();
  } else {
    $('#div_c_operasi_di_daerah_pelvis_operasi_digestif_lainnya').hide();
  }
}

// Behaviours
$('input[name="{{ $ns }}c_operasi_di_daerah_pelvis_operasi_digestif_lainnya"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_operasi_di_daerah_pelvis_operasi_digestif_lainnya = ifChanged");
  show_hide_c_operasi_di_daerah_pelvis_operasi_digestif_lainnya();
});

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
show_hide_c_operasi_di_daerah_pelvis_operasi_digestif_lainnya();
@endsection
