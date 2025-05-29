@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}
  @php
    function tpl_box_1_2($name = '', $args = []){
        $hide_2 = (isset($args['hide_2']) && $args['hide_2']);
        $only_2 = (isset($args['only_2']) && $args['only_2']);

        $item_2 = BS::textbox([
            'name' => $name.'_2',
            'size' => 5,
            'inline' => true,
            ], false
        ).' mg';
        if ($only_2) return BS::number([
            'name' => $name.'_2',
            'inline' => true,
            'step' => '0.01',
        ], false).' mg';
        if ($hide_2) $item_2 = '';

        $s = '<div style="margin:0.5em 0">'.BS::textbox([
            'name' => $name.'_1',
            'size' => 5,
            'inline' => true,
            ], false
        ).' x sehari</div>'
        .$item_2;

        return $s;
    }

    FORM::setup([
      'action' => $form_action
    ]);
    FORM::set_var($default);

    // Begin Follow Up : Form OAB_terapi_medikamentosa
    //====================[ Begin Follow Up : Form OAB_terapi_medikamentosa ]===
    $ns = '';
    $field = $ns.'medikamentosa';
    FORM::row(
        'Medikamentosa',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                'Teratur',
                'Tidak Teratur',
            ),
            ], false
        )
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    FORM::row(':header', 'Anti Muskarinik');
    $field = $ns.'solifenacin';
    FORM::row(
        'Solifenacin',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '5 mg',
                '10 mg',
            ),
            ], false
        )
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    $field = $ns.'imidafenacin';
    FORM::row(
        'Imidafenacin',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        /*
        .BS::number([
            'name' => $field.'_ya',
            'inline' => true,
            ], false
        )
        .' dosis'
        */
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        .BS::checkbox([
            'name' => 'c_imidafenacin_0_1_mg',
            'caption' => '0,1 mg',
        ], false)
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    $field = $ns.'propiverine';
    FORM::row(
        'Propiverine',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        /*
        .BS::number([
            'name' => $field.'_ya',
            'inline' => true,
            ], false
        )
        .' dosis'
        */
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        /*
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                //'5 mg',
                //'10 mg',
                '15 mg',
            ),
            ], false
        )
        */
        .BS::checkbox([
            'name' => 'c_propiverine_15_mg',
            'caption' => '15 mg',
        ], false)
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    $field = $ns.'tolterodine';
    FORM::row(
        'Tolterodine',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        /*
        .BS::number([
            'name' => $field.'_ya',
            'inline' => true,
            ], false
        )
        .' dosis'
        */
        /*
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '1 mg',
                '2 mg',
            ),
            ], false
        )
        */
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        .BS::checkbox([
            'name' => 'c_tolterodine_2_mg',
            'caption' => '2 mg',
        ], false)
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    $field = $ns.'flavoxate';
    FORM::row(
        'Flavoxate',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '100 mg',
                '200 mg',
            ),
            ], false
        )
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    $field = $ns.'oxybutinin';
    FORM::row(
        'Oxybutinin',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '5 mg',
                '10 mg',
            ),
            ], false
        )
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    FORM::row(':header', 'B3 Agonis');
    $field = $ns.'mirabegron';
    FORM::row(
        'Mirabegron',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '25 mg',
                '50 mg',
            ),
            ], false
        )
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    $field = $ns.'vibegron';
    FORM::row(
        'Vibegron',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        /*
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '50 mg',
                '75 mg',
                '100 mg',
            ),//
            ], false
        )
        */
        .'<div style="display:flex;">'
        .'<div style="width:fit-content;">'
        .BS::checkbox([
            'name' => 'c_vibegron_75_mg',
            'caption' => '75 mg',
        ], false)
        .'</div>'
        .'<div style="flex:1;padding-left:0.5em;">'
        .str_repeat(' &nbsp;', 5)
        .tpl_box_1_2($field, ['only_2' => true])
        .'</div>'
        .'</div>'
        .tpl_box_1_2($field, ['hide_2' => true])
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    // End Follow Up : Form OAB_terapi_medikamentosa
    //======================[ End Follow Up : Form OAB_terapi_medikamentosa ]===

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
