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

    //=================[ Begin Follow Up : Form OAB_kuesioner_bladder_diary ]===
    $ns = '';
    $a = [
        ['Intake cairan / 24 jam', 'intake_cairan'],
        ['Frekuensi kencing dalam 24 jam', 'frekuensi_kencing'],
        ['Nocturia', 'nocturia'],
        ['Porsi miksi', 'porsi_miksi'],
        ['Produksi urin / 24 jam', 'produksi_urin'],
        ['Urgency', 'urgency'],
        ['Inkontinensia urine', 'inkontinensia_urine'],
        ['Poliuria nocturnal', 'poliuria_nocturnal'],
    ];
    $UOM = [
        'intake_cairan' => 'ml',
        'porsi_miksi' => 'ml',
        'produksi_urin' => 'ml',
        'urgency' => 'x',
        'inkontinensia_urine' => 'x',
    ];
    $UOM2 = [
        'nocturia' => ' /malam',
    ];
    foreach($a as $av){
        $field = '';

        switch($av[1]){
            case 'intake_cairan':
            case 'frekuensi_kencing':
            case 'nocturia':
            case 'porsi_miksi':
            case 'produksi_urin':
            case 'urgency':
            case 'inkontinensia_urine':
                $uom = (isset($UOM[$av[1]])) ? $UOM[$av[1]] : '';
                $uom2 = (isset($UOM2[$av[1]])) ? $UOM2[$av[1]] : '';
                $field = BS::number([
                        'name' => $ns.$av[1].'_1',
                        'inline' => true,
                    ], false)
                    .' '.$uom
                    .' s/d '
                    .BS::number([
                        'name' => $ns.$av[1].'_2',
                        'inline' => true,
                    ], false).' '.$uom
                    .$uom2;
                break;

            case 'poliuria_nocturnal':
                $field = BS::radio_ya_tidak([
                    'name' => $ns.$av[1],
                ], false);
                break;
        }

        FORM::row($av[0], $field);
    }
    //=================[ Begin Follow Up : Form OAB_kuesioner_bladder_diary ]===

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
