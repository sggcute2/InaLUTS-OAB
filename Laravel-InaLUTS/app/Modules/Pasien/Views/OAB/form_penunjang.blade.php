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

    FORM::row(
        'UPP',
        BS::radio_array([
            'name' => 'upp',
            'data' => array(
                'Dikerjakan',
                'Tidak Dikerjakan',
            ),
            'vertical' => true,
            'toggle_div_by_value' => [
                'Dikerjakan' => [
                    'id' => 'upp_dikerjakan',
                    'class' => 'indent1',
                    'html' => ''
                        .'<div>'
                        .'<b>maximal urethral pressure :</b> '
                        .BS::number([
                            'name' => 'maximal_urethral_pressure',
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>functional urethral length :</b> '
                        .BS::number([
                            'name' => 'functional_urethral_length',
                            'inline' => true,
                        ], false)
                        .'</div>'
                ],
            ],
            ], false
        )
    );
    if (isset($default['upp']) && $default['upp'] == 'Dikerjakan') {
    } else {
        BS::jquery_ready("$('#upp_dikerjakan').hide();");
    }

    FORM::row(
        'Sistoskopi',
        BS::radio_array([
            'name' => 'sistoskopi',
            'data' => array(
                'Dikerjakan',
                'Tidak Dikerjakan',
            ),
            'vertical' => true,
            'toggle_div_by_value' => [
                'Dikerjakan' => [
                    'id' => 'sistoskopi_dikerjakan',
                    'class' => 'indent1',
                    'html' => ''
                        .'<div>'
                        .'<b>Mukosa buli :</b> '
                        .BS::radio_array([
                            'name' => 'mukosa_buli',
                            'data' => ['Hiperemis', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Trabekulasi :</b> '
                        .BS::radio_array([
                            'name' => 'trabekulasi',
                            'data' => ['Ringan', 'Sedang', 'Berat'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Sakulasi Divertikel :</b> '
                        .BS::radio_array([
                            'name' => 'sakulasi_divertikel',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Kapasitas Buli :</b> '
                        .BS::number([
                            'name' => 'kapasitas_buli',
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Batu :</b> '
                        .BS::radio_array([
                            'name' => 'batu',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Tumor :</b> '
                        .BS::radio_array([
                            'name' => 'tumor',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Lobus Medius :</b> '
                        .BS::radio_array([
                            'name' => 'lobus_medius',
                            'data' => ['Tinggi', 'Tidak Tinggi'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Kissing Lobe :</b><br>'
                        .BS::radio_array([
                            'name' => 'kissing_lobe',
                            'data' => ['Ya', 'Tidak'],
                            'vertical' => true,
                            'toggle_div_by_value' => [
                                'Ya' => [
                                        'id' => 'kissing_lobe_ya',
                                        'class' => 'indent1',
                                        'html' => ''
                                            .BS::number([
                                                'name' => 'kissing_lobe_ya',
                                                'required' => false,
                                                'inline' => true,
                                            ], false)
                                            .' cm',
                                    ],
                            ],
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Muara Ureter :</b> '
                        .BS::radio_array([
                            'name' => 'muara_ureter',
                            'data' => ['Normal', 'Tidak Normal'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Urethra :</b> '
                        .BS::radio_array([
                            'name' => 'urethra',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>MUE :</b> '
                        .BS::radio_array([
                            'name' => 'mue',
                            'data' => ['Stenosis', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                        .'<div style="margin-top:1em">'
                        .'<b>Lichen Schlerosis :</b> '
                        .BS::radio_array([
                            'name' => 'lichen_schlerosis',
                            'data' => ['Ya', 'Tidak'],
                            'inline' => true,
                        ], false)
                        .'</div>'
                ],
            ],
            ], false
        )
    );
    if (isset($default['sistoskopi']) && $default['sistoskopi'] == 'Dikerjakan') {
    } else {
        BS::jquery_ready("$('#sistoskopi_dikerjakan').hide();");
    }
    if (isset($default['kissing_lobe']) && $default['kissing_lobe'] == 'Ya') {
    } else {
        BS::jquery_ready("$('#kissing_lobe_ya').hide();");
    }

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
