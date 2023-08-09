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
    Antihipertensi
    Obat diabetik
    Obat-obatan psikiatri
    Obat-obatan COPD
    Obat-obatan asma
    Obat-obatan alergi
    Obat-obatan saraf
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

            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .BS::radio_array([
                    'name' => $field.'_ya',
                    'data' => array(
                        'Teratur',
                        'Tidak Teratur',
                    ),
                    'vertical' => true,
                    ], false
                )
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
