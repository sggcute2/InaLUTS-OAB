@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}
  @php
    $after_checkValidation = "
      setTimeout(function(){
        jQuery('#'+NS+'the_buttons').show();
        jQuery('#'+NS+'waiting').hide();
      }, 5000);
    ";
    FORM::setup([
      'action' => $form_action,
      'after_checkValidation' => $after_checkValidation,
    ]);
    FORM::set_var($default);

    FORM::row(
      'Jenis kelamin',
      BS::radio_array([
        'name' => 'jenis_kelamin_id',
        'data' => array(
          array(
            'value' => '1',
            'text' => 'Laki-laki',
          ),
          array(
            'value' => '2',
            'text' => 'Perempuan',
          ),
        ),
      ], false)
    );

    FORM::row(
        'Usia',
        BS::number([
            'name' => 'usia_1',
            'inline' => true,
        ], false)
        .' s/d '
        .BS::number([
            'name' => 'usia_2',
            'inline' => true,
        ], false)
    );

    FORM::row(
        'Diagnosis OAB',
        BS::checkbox([
            'name' => 'diagnosis_basah',
            'caption' => 'OAB Tipe Basah',
        ], false)
        .BS::checkbox([
            'name' => 'diagnosis_kering',
            'caption' => 'OAB Tipe Kering',
        ], false)
    );

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection
