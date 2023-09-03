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

    ob_start();
    echo '<p class="pull-right">'.PHP_EOL;
    echo BS::button('Add New', $add_action).PHP_EOL;
    echo '</p>'.PHP_EOL;
    echo '<br><br>'.PHP_EOL;
    DT::view('injeksi_botox');
    $injeksi_botox = ob_get_contents();
    ob_end_clean();

    $field = 'injeksi_botox';
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
            $field = strtolower(str_replace(array(' ', '/'), '_', $caption));

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
                ], false)
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
