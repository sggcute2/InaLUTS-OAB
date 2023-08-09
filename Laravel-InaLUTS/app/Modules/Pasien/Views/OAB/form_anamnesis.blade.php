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

    $temp = 'Urgensi,Frekuensi,Nokturia,Inkontinensia Urine';
    FORM::row(
      'Keluhan Utama',
      BS::select2([
        'name' => 'keluhan_utama',
        'data' => explode(',', $temp),
        'with_blank' => true,
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
