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
    Menurunkan berat badan;menurunkan_berat_badan
    Penilaian jenis dan jumlah asupan cairan;penilaian_jenis
    Bladder training;bladder_training
    Stop merokok;stop_merokok
    Management stress;management_stress
    Manajemen komorbid (termasuk konstipasi, PPOK, asma, dll);manajemen_komorbid
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
                    'toggle_div' => true,
                ], false)
            );

            if ($field == 'bladder_training') {
                $a = [
                    'Timed Voiding',
                    'Prompt Voiding',
                    'Urge Suppression Strategies',
                ];
                $buffer = [];
                foreach($a as $va){
                    $field_va = strtolower(
                        str_replace(array(' ', '-'), '_', $va)
                    );

                    $ext = '';
                    if ($field_va == 'timed_voiding') {
                        $ext .= '<div id="div_c_bladder_training_timed_voiding" class="indent1">';
                        $ext .= BS::checkbox([
                            'name' => 'c_bladder_training_timed_voiding_berkemih_spontan',
                            'caption' => 'Berkemih Spontan',
                        ], false);
                        $ext .= BS::checkbox([
                            'name' => 'c_bladder_training_timed_voiding_katerisasi',
                            'caption' => 'Katerisasi',
                        ], false);
                        $ext .= '</div>';
                    }

                    $buffer[] = BS::checkbox([
                        'name' => 'c_'.$field.'_'.$field_va,
                        'caption' => $va,
                    ], false).$ext;
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

// Functions
function show_hide_c_bladder_training_timed_voiding(){
  const len = ($('input[name="c_bladder_training_timed_voiding"]:checked').length !== 0);
  if (len == '1') {
    $('#div_c_bladder_training_timed_voiding').show();
  } else {
    $('#div_c_bladder_training_timed_voiding').hide();
  }
}

// Behaviours
$('input[name="c_bladder_training_timed_voiding"]').on('ifChanged', function(){
  show_hide_c_bladder_training_timed_voiding();
});

// Init
show_hide_c_bladder_training_timed_voiding();
if (disable_all) form_disable_all_fields('{{ MODULE }}');
@endsection
