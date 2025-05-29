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
    $temp .= 'OABSS'.PHP_EOL;
    //$temp .= 'QOL'.PHP_EOL;
    $temp .= 'IPSS'.PHP_EOL;
    if ($data_pasien->jenis_kelamin_id == 1) {
        // Laki-laki
        $temp .= 'IIEF'.PHP_EOL;
        $temp .= 'EHS'.PHP_EOL;
    } else if ($data_pasien->jenis_kelamin_id == 2) {
        // Perempuan
        $temp .= 'FSFI'.PHP_EOL;
    }
    $temp .= 'Bladder Diary';
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
        'Sistem skor',
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
