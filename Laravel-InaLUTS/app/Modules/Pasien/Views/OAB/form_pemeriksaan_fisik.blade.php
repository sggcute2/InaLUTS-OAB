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

    $field = 'gangguan_neurologi';
    FORM::row(
        'Gangguan neurologi',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    $a = [
        'Tremor',
        'Fascial Palsy',
        'Hemiparesis',
        'Paraparesis',
        'Tetraparesis',
        'Hemiplegi',
        'Paraplegi',
    ];
    $buffer = [];
    foreach($a as $va){
        $field_va = strtolower(
            str_replace(array(' ', '-'), '_', $va)
        );
        $buffer[] = BS::checkbox([
            'name' => 'c_'.$field.'_'.$field_va,
            'caption' => $va,
        ], false);
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

    $temp = '
        Cor
        Pulmo
        Bulbocavernosus refleks
        Atrofi vagina
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            if ($field == 'bulbocavernosus_refleks') {
                $data = ['Ada', 'Tidak'];
            } else if ($field == 'atrofi_vagina') {
                $data = ['Ya', 'Tidak', 'NA'];
            } else {
                $data = ['Normal', 'Tidak'];
            }

            FORM::row(
                $caption,
                BS::radio_array([
                    'name' => $field,
                    'data' => $data,
                ], false)
            );
        }
    }

    $temp = '
        POP
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(' ', '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );
            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .BS::radio_array([
                    'name' => $field.'_ya',
                    'data' => [
                        'Prolaps', 'Vagina Anterior', 'Apikal',
                        'Vagina Posterior (grade I-II-III-IV)'
                    ],
                ], false)
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }

    $temp = '
        Massa di daerah pelvis
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(' ', '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    ], false)
            );
        }
    }

    $field = 'uretra';
    FORM::row(
        'Uretra',
        BS::radio_array([
            'name' => $field,
            'data' => ['Normal', 'Tidak'],
            'vertical' => true,
            'toggle_div_by_value' => [
                'Tidak' => [
                    'id' => 'div_'.$field.'_tidak',
                    'class' => 'indent1',
                    'html' =>
                        BS::checkbox([
                            'name' => 'c_uretra_caruncle',
                            'caption' => 'Caruncle',
                        ], false)
                        .BS::checkbox([
                            'name' => 'c_uretra_stenosis',
                            'caption' => 'Stenosis',
                        ], false),
                ],
            ],
        ], false)
    );
    if (isset($default[$field]) && $default[$field] == 'Tidak') {
    } else {
        BS::jquery_ready("$('#div_{$field}_tidak').hide();");
    }

    $temp = '
        Tonus spingter ani
        Tonus levator ani
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            if ($field == 'tonus_spingter_ani') {
                $data = ['Normal', 'Melemah', 'Meningkat'];
            } else if ($field == 'tonus_levator_ani') {
                $data = ['Normal', 'Tidak'];
            }

            FORM::row(
                $caption,
                BS::radio_array([
                    'name' => $field,
                    'data' => $data,
                ], false)
            );
        }
    }

    FORM::row(
        'Pelvic floor',
            'OXFORD grading scale : '
            .BS::radio_array([
                'name' => 'pelvic_floor',
                'data' => ['0', '1', '2', '3', '4', '5'],
            ], false)
    );

    $field = 'prostat';
    FORM::row(
        'Prostat',
        BS::radio_array([
            'name' => $field,
            'data' => ['Normal', 'Tidak', 'NA'],
            'vertical' => true,
            'toggle_div_by_value' => [
                'Tidak' => [
                    'id' => 'div_'.$field.'_tidak',
                    'class' => 'indent1',
                    'html' =>
                        BS::radio_array([
                            'name' => 'prostat_tidak',
                            'data' => [
                                'Keras',
                                'Nodul',
                                'Nyeri Tekan',
                                'Berbenjol',
                            ],
                        ], false),
                ],
            ],
        ], false)
    );
    if (isset($default[$field]) && $default[$field] == 'Tidak') {
    } else {
        BS::jquery_ready("$('#div_{$field}_tidak').hide();");
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
