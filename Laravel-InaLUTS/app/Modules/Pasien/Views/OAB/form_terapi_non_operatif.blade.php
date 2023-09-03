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
    Tatalaksana non operatif;tatalaksana_non_operatif
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $x2 = explode(';', trim($v));
            $caption = trim($x2[0]);
            $field = trim($x2[1]);

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => in_array($field, [
                        'tatalaksana_non_operatif',
                    ]),
                ], false)
            );

            if ($field == 'tatalaksana_non_operatif') {
                $a = [
                    'Kateter menetap',
                    'Kateter berkala',
                    'Penggunaan diapers',
                    'Penile clamp',
                    'Kondom kateter',
                ];
                $buffer = [];
                foreach($a as $va){
                    $field_va = strtolower(
                        str_replace(array(' ', '-'), '_', $va)
                    );

                    $buffer[] = '<div style="margin-bottom:1em">'
                        .$va.' : '
                        .BS::radio_ya_tidak([
                            'name' => $field_va,
                        ], false)
                        .'</div>';
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
            } else if ($field == 'ptns') {
                $a = [
                    'Frekuensi;x/minggu',
                    'Durasi;x',
                ];
                $buffer = [];
                foreach($a as $va){
                    $xa = explode(';', trim($va));
                    $caption_va = trim($xa[0]);
                    $ext_va = trim($xa[1]);
                    $field_va = strtolower(
                        str_replace(array(' ', '-'), '_', $caption_va)
                    );

                    $buffer[] = '<div style="margin-bottom:1em">'.$caption_va.' : '.BS::number([
                        'name' => $field.'_'.$field_va,
                        'caption' => $caption_va,
                        'inline' => true,
                    ], false).' '.$ext_va.'</div>';
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
            } else {
                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .'</div>'
                );
                if (isset($default[$field]) && $default[$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$field}_ya').hide();");
                }
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
