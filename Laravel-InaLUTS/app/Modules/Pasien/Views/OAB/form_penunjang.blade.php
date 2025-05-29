@extends('layouts.user')

@section('title')
  {{ 'Sistoskopi' }}
@endsection

@section('content')
  {{ BS::box_begin('Sistoskopi') }}
  @php
    FORM::setup([
      'action' => $form_action
    ]);
    FORM::set_var($default);

    /*
    FORM::row(
        'PVR',
        BS::number([
            'name' => 'pvr',
            'inline' => true,
        ], false).' ml'
    );
    FORM::row(
        'Cara mengukur PVR',
        BS::radio_array([
            'name' => 'cara_mengukur_pvr',
            'data' => ['USG', 'Kateterisasi'],
        ], false)
    );
    */

    //===========================[ Begin Follow Up : Form OAB_penunjang_upp ]===
/*
    $ns = '';
    FORM::row(
        'UPP',
        BS::radio_array([
            'name' => $ns.'upp',
            'data' => array(
                'Dikerjakan',
                'Tidak Dikerjakan',
            ),
            'vertical' => true,
            'toggle_div_by_value' => [
                'Dikerjakan' => [
                    'id' => $ns.'upp_dikerjakan',
                    'class' => 'indent1',
                    'html' => ''
                        .'<div>'
                        .'<b>maximal urethral pressure :</b> '
                        .BS::number([
                            'name' => $ns.'maximal_urethral_pressure',
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>functional urethral length :</b> '
                        .BS::number([
                            'name' => $ns.'functional_urethral_length',
                            'inline' => true,
                        ], false)
                        .'</div>'
                ],
            ],
            ], false
        )
    );
    if (isset($default[$ns.'upp']) && $default[$ns.'upp'] == 'Dikerjakan') {
    } else {
        BS::jquery_ready("$('#{$ns}upp_dikerjakan').hide();");
    }
*/
    //=============================[ End Follow Up : Form OAB_penunjang_upp ]===

    //====================[ Begin Follow Up : Form OAB_penunjang_sistoskopi ]===
    $ns = '';
    FORM::row(
        'Sistoskopi',
        BS::radio_array([
            'name' => $ns.'sistoskopi',
            'data' => array(
                'Dikerjakan',
                'Tidak Dikerjakan',
            ),
            'vertical' => true,
            'toggle_div_by_value' => [
                'Dikerjakan' => [
                    'id' => $ns.'sistoskopi_dikerjakan',
                    'class' => 'indent1',
                    'html' => ''
                        .'<div style="margin-top:1em">'
                        .'<b>MUE :</b> '
                        .BS::radio_array([
                            'name' => $ns.'mue',
                            'data' => ['Stenosis', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Urethra :</b> '
                        .BS::radio_array([
                            'name' => $ns.'urethra',
                            'data' => ['Stenosis', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'

                        .'<div style="margin-top:1em">'
                        .'<b>Prostat :</b><br>'
                        .BS::radio_array([
                            'name' => $ns.'prostat',
                            'data' => ['Ya', 'N/A'],
                            'vertical' => true,
                            'toggle_div_by_value' => [
                                'Ya' => [
                                        'id' => $ns.'prostat_ya',
                                        'class' => 'indent1',
                                        'html' => ''
                                            .'Kissing Lobe : '
                                            .BS::radio_ya_tidak([
                                                'name' => 'kissing_lobe',
                                            ], false)
                                            .'<br>'
                                            .'Lobus Medius : '
                                            .BS::radio_ya_tidak([
                                                'name' => 'lobus_medius',
                                            ], false)
                                    ],
                            ],
                        ], false)
                        .'<br><br>'
                        .'</div>'

/*
                        .'<div style="margin-top:1em">'
                        .'<b>Kissing Lobe :</b><br>'
                        .BS::radio_array([
                            'name' => $ns.'kissing_lobe',
                            'data' => ['Ya', 'Tidak'],
                            'vertical' => true,
                            'toggle_div_by_value' => [
                                'Ya' => [
                                        'id' => $ns.'kissing_lobe_ya',
                                        'class' => 'indent1',
                                        'html' => ''
                                            .BS::number([
                                                'name' => $ns.'kissing_lobe_ya',
                                                'required' => false,
                                                'inline' => true,
                                            ], false)
                                            .' cm',
                                    ],
                            ],
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Lobus Medius :</b> '
                        .BS::radio_array([
                            'name' => $ns.'lobus_medius',
                            'data' => ['Tinggi', 'Tidak Tinggi'],
                            'inline' => true,
                        ], false)
                        .'</div>'
*/

                        .'<div>'
                        .'<b>Mukosa buli :</b> '
                        .BS::radio_array([
                            'name' => $ns.'mukosa_buli',
                            'data' => ['Hiperemis', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Trabekulasi :</b> '
                        .BS::radio_array([
                            'name' => $ns.'trabekulasi',
                            'data' => ['Ringan', 'Sedang', 'Berat'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Sakulasi / Divertikel :</b> '
                        .BS::radio_array([
                            'name' => $ns.'sakulasi_divertikel',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Kapasitas Buli :</b> '
                        .BS::number([
                            'name' => $ns.'kapasitas_buli',
                            'inline' => true,
                        ], false).' ml'
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Batu :</b> '
                        .BS::radio_array([
                            'name' => $ns.'batu',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Tumor :</b> '
                        .BS::radio_array([
                            'name' => $ns.'tumor',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Muara Ureter :</b> '
                        .BS::radio_array([
                            'name' => $ns.'muara_ureter',
                            'data' => ['Normal', 'Tidak Normal'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                ],
            ],
            ], false
        )
    );
    if (isset($default[$ns.'sistoskopi']) && $default[$ns.'sistoskopi'] == 'Dikerjakan') {
    } else {
        BS::jquery_ready("$('#{$ns}sistoskopi_dikerjakan').hide();");
    }
    if (isset($default[$ns.'prostat']) && $default[$ns.'prostat'] == 'Ya') {
    } else {
        BS::jquery_ready("$('#{$ns}prostat_ya').hide();");
    }
    //======================[ End Follow Up : Form OAB_penunjang_sistoskopi ]===

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
@endsection
