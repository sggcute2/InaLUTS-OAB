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

    $temp = '
        <i>Frequency</i>
        <i>Urgency</i>
        Nokturia
        Inkontinensia Urine
        Pancaran Lemah
        <i>Hesitancy</i>
        Tidak Lampias
        <i>Straining</i>
        <i>Intermittency</i>
        <i>Terminal dribbling</i>
        <i>Post void dribbling</i>
        Hematuria
        Disuria
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(' ', '_', str_replace(array('<i>','</i>'), '', $caption)));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'with_blank' => true,
                    ], false)
            );
        }
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
