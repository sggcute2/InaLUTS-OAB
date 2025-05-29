@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}
  @php
    $list_profil_gula_darah = [
        'Gula Darah Sewaktu',
        'Gula Darah Puasa',
        'GD2PP',
        'HbA1C',
    ];
    FORM::setup([
      'action' => $form_action
    ]);
    FORM::set_var($default);

    FORM::row(
      'Tanggal',
      BS::datepicker([
        'name' => 'lab_date',
        'required' => true,
      ], false)
    );

    //GDS, GDP, GD2PP, HbA1c
    $temp = '
        Hb
        Leukosit
        Trombosit
        Ureum
        Kreatinin
        Profil Gula Darah
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));
            //if ($field == 'gds,_gdp,_gd2pp,_hba1c') $field = 'gds';

            $step = '';
            if ($field == 'hb') $step = '0.1';
            if ($field == 'ureum' || $field == 'kreatinin') $step = '0.01';

            if ($field == 'profil_gula_darah') {
                $temp_choice = '<div id="div_profil_gula_darah">';
                foreach($list_profil_gula_darah as $va){
                    $field2 = strtolower(str_replace(array(' ', '-'), '_', $va));

                    $temp_value = BS::number([
                        'name' => $field2,
                        'disable_negative' => true,
                    ], false);

                    $temp_choice .= '<div style="margin-top:1em">';
                    $temp_choice .= BS::checkbox([
                        'name' => 'c_'.$field2,
                        'caption' => $va,
                    ], false)
                    .'<div id="div_c_'.$field2.'" class="indent1">'.$temp_value.'</div>';
                    $temp_choice .= '</div>';
                }
                $temp_choice .= '</div>';

                FORM::row(
                    $caption,
                    BS::radio_ya_tidak([
                        'name' => $field,
                        'toggle_div' => true,
                    ], false)
                    .'<div id="div_'.$field.'_ya" class="indent2">'
                    . $temp_choice
                    . '</div>'
                );

                if (isset($default[$field]) && $default[$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$field}_ya').hide();");
                }
            } else {
                FORM::row(
                    $caption,
                    BS::number([
                        'name' => $field,
                        'disable_negative' => true,
                        'step' => $step,
                    ], false)
                );
            }
        }
    }

    FORM::row(':header', 'Urinalisa');
    $temp = '
    PH
    Protein
    Glukosa
    Nitrit
    Leukosit esterase
    Eritrosit
    Leukosit
    Kristal
    Bakteri
    Jamur
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            $step = '';
            if ($field == 'ph') $step = '0.1';

            if (
                $field == 'protein'
                || $field == 'nitrit'
                || $field == 'kristal'
                || $field == 'bakteri'
                || $field == 'jamur'
            ) {
                FORM::row(
                    $caption,
                    BS::radio_array([
                        'name' => $field,
                        'data' => ['+', '-'],
                    ], false)
                );
            } else if (
                $field == 'eritrosit'
                || $field == 'leukosit'
            ) {
                FORM::row(
                    $caption,
                    BS::number([
                        'name' => $field.'_1',
                        'inline' => true,
                        'disable_negative' => true,
                    ], false)
                    .' s/d '
                    .BS::number([
                        'name' => $field.'_2',
                        'inline' => true,
                        'disable_negative' => true,
                    ], false)
                );
            } else if (
                $field == 'leukosit_esterase'
            ) {
                FORM::row(
                    $caption,
                    BS::radio_array([
                        'name' => $field,
                        'data' => ['+1', '+2', '+3', '-'],
                    ], false)
                );
            } else {
                FORM::row(
                    $caption,
                    BS::number([
                        'name' => $field,
                        'disable_negative' => true,
                        'step' => $step,
                    ], false)
                );
            }
        }
    }

    $temp_choice = '';
    foreach(['Sterile', 'Jenis Bakteri'] as $va){
        $field2 = strtolower(str_replace(array(' ', '-'), '_', $va));

        $temp_value = '';
        if ($field2 == 'jenis_bakteri') {
            $temp_value = BS::textbox([
                'name' => 'jenis_bakteri',
            ], false);
            $temp_value .= '<div>';
            $temp_value .= 'Jumlah Bakteri dalam satuan colony forming unit per ml : ';
            $temp_value .= BS::textbox([
                'name' => 'jumlah_bakteri',
                'inline' => true,
            ], false);
            $temp_value .= '</div>';
        }//

        $temp_choice .= '<div style="margin-top:1em">';
        $temp_choice .= BS::checkbox([
            'name' => 'c_'.$field2,
            'caption' => $va,
        ], false)
        .'<div id="div_c_'.$field2.'" class="indent1">'.$temp_value.'</div>';
        $temp_choice .= '</div>';
    }
    $field = 'kultur_urin';
    FORM::row(
        'Kultur Urin (Jenis kuman)',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
        .'<div id="div_'.$field.'_ya" class="indent2">'
        . $temp_choice
        . '</div>'
    );

    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Functions
@foreach($list_profil_gula_darah as $va)
  @php
  $field2 = strtolower(str_replace(array(' ', '-'), '_', $va));
  @endphp
function show_hide_c_{{ $field2 }}(){
  const len = ($('input[name="c_{{ $field2 }}"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_{{ $field2 }}').show();
  } else {
    $('#div_c_{{ $field2 }}').hide();
  }
}
@endforeach
function show_hide_c_jenis_bakteri(){
  const len = ($('input[name="c_jenis_bakteri"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_jenis_bakteri').show();
  } else {
    $('#div_c_jenis_bakteri').hide();
  }
}

// Behaviours
@foreach($list_profil_gula_darah as $va)
  @php
  $field2 = strtolower(str_replace(array(' ', '-'), '_', $va));
  @endphp
$('input[name="c_{{ $field2 }}"]').on('ifChanged', function(){
  //console.log("c_{{ $field2 }} = ifChanged");
  show_hide_c_{{ $field2 }}();
});
@endforeach
$('input[name="c_jenis_bakteri"]').on('ifChanged', function(){
  //console.log("c_jenis_bakteri = ifChanged");
  show_hide_c_jenis_bakteri();
});

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
@foreach($list_profil_gula_darah as $va)
  @php
  $field2 = strtolower(str_replace(array(' ', '-'), '_', $va));
  @endphp
show_hide_c_{{ $field2 }}();
@endforeach
show_hide_c_jenis_bakteri();

@endsection
