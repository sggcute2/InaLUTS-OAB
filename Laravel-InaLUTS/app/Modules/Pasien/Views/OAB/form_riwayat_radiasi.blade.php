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
        Riwayat radiasi pelvis
        Riwayat kemoterapi
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );

            $a = [
                'Keganasan saluran kemih',
                'Keganasan saluran cerna',
                'Keganasan ginekologi',
            ];
            $buffer = [];
            foreach($a as $va){
                $field_va = strtolower(
                    str_replace(array(' ', '-'), '_', $va)
                );
                $buffer[] = BS::checkbox([
                    'name' => 'c_'.$field.'_'.$field_va,
                    'caption' => $va,
                ], false);
            }

            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .implode('', $buffer)
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
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
