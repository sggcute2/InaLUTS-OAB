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

    //====[ Begin Follow Up : Form OAB_kuesioner_pemeriksaan_penunjang__usg ]===
    $ns = '';
    FORM::row(
        'USG (abdominal / transrektal)',
        BS::radio_array([
            'name' => $ns.'usg',
            'data' => ['Dilakukan', 'Tidak Dilakukan'],
            'vertical' => true,
            'toggle_div_by_value' => [
                'Dilakukan' => [
                        'id' => 'usg_dilakukan__date',
                        'class' => 'indent1',
                        'html' => 'Tanggal : '
                            .BS::datepicker([
                                'name' => $ns.'usg_date',
                                'required' => false,
                            ], false),
                    ],
            ],
        ], false)
    );
    if (isset($default[$ns.'usg']) && $default[$ns.'usg'] == 'Dilakukan') {
    } else {
        BS::jquery_ready("$('#".$ns."usg_dilakukan__date').hide();");
    }

    $field = 'ct_urografi';
    FORM::row(
        'CT Urografi',
        BS::radio_ya_tidak([
            'name' => $ns.$field,
        ], false)
    );

    FORM::row(':header', 'Ginjal');
    FORM::row(':merge', '<b>Kanan</b>');
    FORM::row(
        '<div class="indent1">Hidronefrosis</div>',
        '<div class="indent1">'
        .BS::radio_array([
            'name' => $ns.'ginjal__kanan__hidronefrosis',
            'data' => ['Tidak', 'Ringan', 'Sedang', 'Berat'],
        ], false)
        .'</div>'
    );
    FORM::row(
        '<div class="indent1">Batu</div>',
        '<div class="indent1">'
        .BS::radio_array([
            'name' => $ns.'ginjal__kanan__batu',
            'data' => ['Ada', 'Tidak'],
        ], false)
        .'</div>'
    );
    FORM::row(':merge', '<b>Kiri</b>');
    FORM::row(
        '<div class="indent1">Hidronefrosis</div>',
        '<div class="indent1">'
        .BS::radio_array([
            'name' => $ns.'ginjal__kiri__hidronefrosis',
            'data' => ['Tidak', 'Ringan', 'Sedang', 'Berat']
        ], false)
        .'</div>'
    );
    FORM::row(
        '<div class="indent1">Batu</div>',
        '<div class="indent1">'
        .BS::radio_array([
            'name' => $ns.'ginjal__kiri__batu',
            'data' => ['Ada', 'Tidak']
        ], false)
        .'</div>'
    );

    FORM::row(':header', 'Buli');
    $a = [
        'Batu',
        'Divertikel',
        'Massa intrabuli',
    ];
    foreach($a as $v){
        $caption = trim($v);
        $field = strtolower(str_replace(' ', '_', $caption));
        FORM::row(
            $caption,
            BS::radio_array([
                'name' => $ns.'buli__'.$field,
                'data' => ['Ada', 'Tidak']
            ], false)
        );
    }
    //======[ End Follow Up : Form OAB_kuesioner_pemeriksaan_penunjang__usg ]===

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
