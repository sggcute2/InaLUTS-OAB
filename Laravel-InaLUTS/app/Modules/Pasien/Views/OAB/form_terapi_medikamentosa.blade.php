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
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '5 mg',
                '10 mg',
            ),
            ], false
        )
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
        .BS::number([
            'name' => $field.'_ya',
            'inline' => true,
            ], false
        )
        .' dosis'
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
        .BS::number([
            'name' => $field.'_ya',
            'inline' => true,
            ], false
        )
        .' dosis'
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
        .BS::number([
            'name' => $field.'_ya',
            'inline' => true,
            ], false
        )
        .' dosis'
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
        ], false)
    );

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
        .BS::radio_array([
            'name' => $field.'_ya',
            'data' => array(
                '25 mg',
                '50 mg',
            ),
            ], false
        )
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
