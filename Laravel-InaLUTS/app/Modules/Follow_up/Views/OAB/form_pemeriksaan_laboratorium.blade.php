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
      'Tanggal',
      BS::datepicker([
        'name' => 'lab_date',
        'required' => true,
      ], false)
    );

    $temp = '
        Hb
        Leukosit
        Trombosit
        Ureum
        Kreatinin
        GDS, GDP, GD2PP, HbA1c
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));
            if ($field == 'gds,_gdp,_gd2pp,_hba1c') $field = 'gds';

            FORM::row(
                $caption,
                BS::number([
                    'name' => $field,
                ], false)
            );
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
            if ($field == 'leukosit') $field = 'urinalisa_leukosit';

            FORM::row(
                $caption,
                BS::number([
                    'name' => $field,
                ], false)
            );
        }
    }

    FORM::row(
        'Kultur Urin (Jenis kuman)',
        BS::textbox([
            'name' => 'kultur_urin',
        ], false)
    );

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
