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

    FORM::row(':header2', 'Diagnosis Terakhir');
    //===============================[ Begin Follow Up : Form OAB_diagnosis ]===
    $ns = 'OAB_diagnosis_';
    $temp = 'OAB Tipe Basah,OAB Tipe Kering';
    FORM::row(
      'Diagnosis',
      BS::select2([
        'name' => $ns.'diagnosis',
        'data' => explode(',', $temp),
        'with_blank' => true,
        ], false)
    );
    //=================================[ End Follow Up : Form OAB_diagnosis ]===

    FORM::row(':header2', 'Terapi Medikamentosa Terakhir');
    //====================[ Begin Follow Up : Form OAB_terapi_medikamentosa ]===
    $ns = 'OAB_terapi_medikamentosa_';
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

    $field = $ns.'flavoxate';
    FORM::row(
        'Flavoxate',
        BS::radio_ya_tidak([
            'name' => $field,
        ], false)
    );
    //======================[ End Follow Up : Form OAB_terapi_medikamentosa ]===

    FORM::row(':header2', 'Terapi Operatif Terakhir');
    //=========================[ Begin Follow Up : Form OAB_terapi_operatif ]===
    ob_start();
    DT::view('injeksi_botox');
    $injeksi_botox = ob_get_contents();
    ob_end_clean();

    $ns = 'OAB_terapi_operatif_';
    $field = $ns.'injeksi_botox';
    FORM::row(
        'Injeksi Botox',
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .$injeksi_botox
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    $temp = '
        SNS
        Augmentasi/Cystoplasty
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = $ns.strtolower(str_replace(array(' ', '/'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );

            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .'Tanggal : '
                .BS::datepicker([
                    'name' => $field.'_ya_date',
                    'required' => false,
                    'disabled' => true,
                ], false)
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }
    //===========================[ End Follow Up : Form OAB_terapi_operatif ]===

    FORM::row(':header2', 'Follow Up');
    FORM::row('Tanggal Pemeriksaan',
        BS::datepicker([
            'name' => 'pemeriksaan_date',
            'required' => true,
        ], false)
    );
    if ($mode == 'add') {
        FORM::row('Tempat Pemeriksaan', '<span style="color:green">'.USER_RUMAH_SAKIT_NAME.'</span>');
        FORM::hidden('rumah_sakit_id', USER_RUMAH_SAKIT_ID);
    } else if ($mode == 'edit') {
        FORM::row('Tempat Pemeriksaan', '<span style="color:green">'.($rumah_sakit->name ?? '').'</span>');
    }

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
//if (disable_all) form_disable_all_fields('{{ MODULE }}');
form_disable_all_fields_by_ns('OAB_diagnosis_');
form_disable_all_fields_by_ns('OAB_terapi_medikamentosa_');
form_disable_all_fields_by_ns('OAB_terapi_operatif_');
@endsection
