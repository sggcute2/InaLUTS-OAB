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
    Alergi/flu/hidung tersumbat;alergi
    Penyakit paru
    Gangguan mood/afektif/jiwa;gangguan_mood
    Diabetes (tipe 1/2/tidak tahu);diabetes
    Penyakit jantung kongestif/P.J Koroner;penyakit_jantung_kongestif
    Penyakit saluran cerna (dyspepsia, GERD, IBS);penyakit_saluran_cerna
    Hipertensi
    Menopause
    Overdistensi buli
    Kanker ginekologi
    Stroke
    Spinal cord injury
    Parkinson
    Penyakit saraf tepi
    HNP
    Multiple sclerosis
    MSA (multiple system atrophy);msa
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $x2 = explode(";", $caption);
            if (count($x2) == 2) {
                $caption = $x2[0];
                $field = strtolower(str_replace(' ', '_', $x2[1]));
            } else {
                $field = strtolower(str_replace(' ', '_', $caption));
            }

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => in_array($field, [
                        'gangguan_mood',
                        'diabetes',
                        'menopause',
                        'kanker_ginekologi',
                        'spinal_cord_injury',
                    ]),
                    'tidak_tahu' => in_array($field, [
                        'diabetes',
                        'hipertensi',
                    ]),
                ], false)
            );

            if ($field == 'gangguan_mood') {
                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .BS::radio_array([
                        'name' => $field.'_ya',
                        'data' => array(
                            'Gangguan Mood',
                            'Psikosis',
                            'Neurosis',
                        ),
                        'vertical' => true,
                        'toggle_div_by_value' => [
                            'Gangguan Mood' => [
                                    'id' => $field.'_ya2__gangguan_mood',
                                    'class' => 'indent2',
                                    'html' => BS::radio_array([
                                        'name' => $field.'_ya2',
                                        'data' => array(
                                            'Bipolar',
                                            'Depresi',
                                            'Manik',
                                        ),
                                        'vertical' => true,
                                    ], false),
                                ],
                        ],
                        ], false
                    )
                    .'</div>'
                );
                if (isset($default[$field]) && $default[$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$field}_ya').hide();");
                }
                if (isset($default[$field.'_ya']) && $default[$field.'_ya'] == 'Gangguan Mood') {
                } else {
                    BS::jquery_ready("$('#{$field}_ya2__gangguan_mood').hide();");
                }
            }

            if ($field == 'diabetes') {
                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .'Lama : '.BS::textbox([
                        'name' => $field.'_ya',
                    ], false)
                    .'</div>'
                );
                if (isset($default[$field]) && $default[$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$field}_ya').hide();");
                }
            }

            if ($field == 'menopause') {
                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .'Lama : '.BS::textbox([
                        'name' => $field.'_ya',
                    ], false)
                    .'</div>'
                );
                if (isset($default[$field]) && $default[$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$field}_ya').hide();");
                }
            }

            if ($field == 'kanker_ginekologi') {
                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .BS::radio_array([
                        'name' => $field.'_ya',
                        'data' => array(
                            'Mioma Uteri',
                            'Endometriosis',
                            'Ca cervix',
                            'Ca ovarium',
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

            if ($field == 'spinal_cord_injury') {
                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .'Trauma tulang belakang : '.BS::radio_ya_tidak([
                        'name' => 'trauma_tulang_belakang',
                        ], false
                    ).'<br>'
                    .'Tumor tulang belakang : '.BS::radio_ya_tidak([
                        'name' => 'tumor_tulang_belakang',
                        ], false
                    ).'<br>'
                    .'Myelitis : '.BS::radio_ya_tidak([
                        'name' => 'myelitis',
                        ], false
                    ).'<br>'
                    .'Spondilitis TB : '.BS::radio_ya_tidak([
                        'name' => 'spondilitis_tb',
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
