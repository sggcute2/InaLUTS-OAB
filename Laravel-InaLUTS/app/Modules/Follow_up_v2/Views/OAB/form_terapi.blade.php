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

    $temp  = '';
    $temp .= 'Modifikasi gaya hidup'.PHP_EOL;
    $temp .= 'Rehabilitasi'.PHP_EOL;
    $temp .= 'Non-Operatif'.PHP_EOL;
    $temp .= 'Medikamentosa'.PHP_EOL;
    $temp .= 'Operatif';
    $x = explode(PHP_EOL, $temp);
    $buffer = [];
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));
            $buffer[] = BS::checkbox([
                'name' => 'c_'.$field,
                'caption' => $v,
            ], false);
        }
    }
    FORM::row(
        'Terapi',
        implode('', $buffer)
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
