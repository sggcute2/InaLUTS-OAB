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

    //=====================[ Begin Follow Up : Form OAB_terapi_non_operatif ]===
    $ns = '';
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
                    'name' => $ns.$field,
                    'toggle_div' => in_array($field, [
                        'tatalaksana_non_operatif',
                    ]),
                ], false)
            );

            if ($field == 'tatalaksana_non_operatif') {
                $a = [
                    'Kateter menetap',
                    'Kateter berkala',
                    'Penggunaan <i>diapers</i>',
                    '<i>Penile clamp</i>',
                    'Kondom kateter',
                ];
                $buffer = [];
                foreach($a as $va){
                    $field_va = strtolower(
                        str_replace(array(' ', '-'), '_', str_replace(array('<i>','</i>'), '', $va))
                    );

                    $buffer[] = '<div style="margin-bottom:1em">'
                        .$va.' : '
                        .BS::radio_ya_tidak([
                            'name' => $ns.$field_va,
                        ], false)
                        .'</div>';
                }

                FORM::row(':merge',
                    '<div id="div_'.$ns.$field.'_ya" class="indent1">'
                    .implode('', $buffer)
                    .'</div>'
                );
                if (isset($default[$ns.$field]) && $default[$ns.$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$ns}{$field}_ya').hide();");
                }
            } else {
                FORM::row(':merge',
                    '<div id="div_'.$ns.$field.'_ya" class="indent1">'
                    .'</div>'
                );
                if (isset($default[$ns.$field]) && $default[$ns.$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$ns}{$field}_ya').hide();");
                }
            }
        }
    }
    //=======================[ End Follow Up : Form OAB_terapi_non_operatif ]===

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
