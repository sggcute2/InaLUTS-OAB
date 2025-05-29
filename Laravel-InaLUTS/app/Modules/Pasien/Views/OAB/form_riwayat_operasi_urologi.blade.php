@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}
  @php
    $ns = '';
    FORM::setup([
      'action' => $form_action
    ]);
    FORM::set_var($default);

    $temp = '
        Instilasi Obat Intravesika
        Injeksi Botox
        Sistoskopi
        Operasi Buli
        Operasi Prostat
        Operasi Uretra
        Operasi anti inkontinensia urine
        Operasi POP
    ';
    /*
        Radikal Prostatektomi;radikal_prostat
        Prostatektomi dan Operasi Prostat Lainnya
    */
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $x2 = explode(";", $caption);
            if (count($x2) == 2) {
                $caption = $x2[0];
                $field = strtolower(str_replace(array(' ', '-'), '_', $x2[1]));
            } else {
                $field = strtolower(str_replace(array(' ', '-'), '_', $caption));
            }

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );

            if ($field == 'operasi_anti_inkontinensia_urine') {
                $a = [
                    'Sling',
                    'Burch Kolposuspensi / Marshall-Marchetti-Krantz procedure (MMK);burch_kolposuspensi',
                    'AUS',
                    'Bulking Agent',
                ];
                $buffer = [];
                foreach($a as $va){
                    $caption = trim($va);
                    $x2 = explode(";", $caption);
                    if (count($x2) == 2) {
                        $caption = $x2[0];
                        $field_va = strtolower(str_replace(array(' ', '-'), '_', $x2[1]));
                    } else {
                        $field_va = strtolower(str_replace(array(' ', '-'), '_', $caption));
                    }

                    $ext = '';
                    if ($field_va == 'sling') {
                        $ext .= '<div id="div_c_operasi_anti_inkontinensia_urine_sling" class="indent1">';
                        $ext .= BS::checkbox([
                            'name' => $ns.'c_operasi_anti_inkontinensia_urine_sling_mid_urethral_sling',
                            'caption' => 'Mid Urethral Sling',
                        ], false);
                        $ext .= BS::checkbox([
                            'name' => $ns.'c_operasi_anti_inkontinensia_urine_sling_autologous_fascial_slin',
                            'caption' => 'Autologous Fascial Sling/Pubovaginal Sling',
                        ], false);
                        $ext .= BS::checkbox([
                            'name' => $ns.'c_operasi_anti_inkontinensia_urine_sling_male_sling',
                            'caption' => 'Male-sling',
                        ], false);
                        $ext .= '</div>';
                    } else if ($field_va == 'burch_kolposuspensi') {
                        /*
                        $ext .= '<div id="div_c_operasi_anti_inkontinensia_urine_burch_kolposuspensi" class="indent1">';
                        $ext .= BS::checkbox([
                            'name' => $ns.'c_operasi_anti_inkontinensia_urine_burch_kolposuspensi_marshall_',
                            'caption' => '/ Marshall-Marchetti-Krantz procedure (MMK)',
                        ], false);
                        $ext .= '</div>';
                        */
                    }

                    $buffer[] = BS::checkbox([
                        'name' => 'c_'.$field.'_'.$field_va,
                        'caption' => $caption,
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
            } else if ($field == 'prostatektomi_dan_operasi_prostat_lainnya') {
                $a = [
                    'Rezum',
                    'Enukleasi Prostae',
                    'Bladder Neck Incision',
                ];
                $buffer = [];
                foreach($a as $va){
                    $field_va = strtolower(
                        str_replace(array(' ', '-'), '_', $va)
                    );
                    if ($field_va == 'bladder_neck_incision') {
                        $field_va = 'bladder_neck_incisio';
                    }

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
            } else if ($field == 'instilasi_obat_intravesika') {
                $a = [
                    'Hyaluronic Acid',
                    'Hyaluronic Acid + Chondroitin Sulfate',
                ];
                $buffer = [];
                foreach($a as $va){
                    $field_va = strtolower(
                        str_replace(array(' ', '-'), '_', $va)
                    );
                    $field_va = str_replace('_+_', '_', $field_va);

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
            } else {
                $ext2 = '';
                if ($field == 'operasi_uretra') {
                    $a = [
                        '<i>Bladder neck incision</i>',
                        '<i>Urethrotomy interna</i>',
                        '<i>Urethroplasty</i>',
                    ];
                    $buffer = [];
                    foreach($a as $va){
                        $field_va = strtolower(
                            str_replace(array(' ', '-'), '_', $va)
                        );
                        $field_va = str_replace(
                            array('<i>', '</i>'),
                            '',
                            $field_va
                        );
    
                        $buffer[] = BS::checkbox([
                            'name' => 'c_'.$field.'_'.$field_va,
                            'caption' => $va,
                        ], false);
                    }

                    $ext2 = '<div style="margin-top:1em">'
                        .'Lamanya : '
                        .BS::number(
                            ['name' => $field.'_tahun', 'inline' => true],
                            false
                        )
                        .' Tahun &nbsp; &nbsp; '
                        .BS::number(
                            ['name' => $field.'_bulan', 'inline' => true],
                            false
                        )
                        .' Bulan &nbsp; &nbsp; '
                        /*
                        .BS::number(
                            ['name' => $field.'_hari', 'inline' => true],
                            false
                        )
                        .' Hari'
                        */
                        .implode('', $buffer)
                        .'</div>';
                } else if ($field == 'operasi_buli') {
                    $a = [
                        'TUR Buli',
                        '<i>Partial Cystectomy</i>',
                    ];
                    $buffer = [];
                    foreach($a as $va){
                        $field_va = strtolower(
                            str_replace(array(' ', '-'), '_', $va)
                        );
                        $field_va = str_replace(
                            array('<i>', '</i>'),
                            '',
                            $field_va
                        );
    
                        $buffer[] = BS::checkbox([
                            'name' => 'c_'.$field.'_'.$field_va,
                            'caption' => $va,
                        ], false);
                    }

                    $ext2 = '<div style="margin-top:1em">'
                        .implode('', $buffer)
                        .'</div>';
                } else if ($field == 'operasi_prostat') {
                    $a = [
                        'Rezum',
                        'Enukleasi Prostat',
                        'HOLEP',
                        'TUR Prostat',
                        'Radikal Prostatektomi',
                    ];
                    $buffer = [];
                    foreach($a as $va){
                        $field_va = strtolower(
                            str_replace(array(' ', '-'), '_', $va)
                        );
                        $field_va = str_replace(
                            array('<i>', '</i>'),
                            '',
                            $field_va
                        );
    
                        $buffer[] = BS::checkbox([
                            'name' => 'c_'.$field.'_'.$field_va,
                            'caption' => $va,
                        ], false);
                    }

                    $ext2 = '<div style="margin-top:1em">'
                        .implode('', $buffer)
                        .'</div>';
                }

                FORM::row(':merge',
                    '<div id="div_'.$field.'_ya" class="indent1">'
                    .'Tanggal : '
                    .BS::datepicker([
                        'name' => $field.'_ya_date',
                    ], false)
                    .$ext2
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
@php
$ns = '';
@endphp
function show_hide_c_operasi_anti_inkontinensia_urine_sling(){
  const len = ($('input[name="{{ $ns }}c_operasi_anti_inkontinensia_urine_sling"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_operasi_anti_inkontinensia_urine_sling').show();
  } else {
    $('#div_c_operasi_anti_inkontinensia_urine_sling').hide();
  }
}
function show_hide_c_operasi_anti_inkontinensia_urine_burch_kolposuspensi(){
  /*
  const len = ($('input[name="{{ $ns }}c_operasi_anti_inkontinensia_urine_burch_kolposuspensi"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_operasi_anti_inkontinensia_urine_burch_kolposuspensi').show();
  } else {
    $('#div_c_operasi_anti_inkontinensia_urine_burch_kolposuspensi').hide();
  }
  */
}

// Behaviours
$('input[name="{{ $ns }}c_operasi_anti_inkontinensia_urine_sling"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_operasi_anti_inkontinensia_urine_sling = ifChanged");
  show_hide_c_operasi_anti_inkontinensia_urine_sling();
});
$('input[name="{{ $ns }}c_operasi_anti_inkontinensia_urine_burch_kolposuspensi"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_operasi_anti_inkontinensia_urine_burch_kolposuspensi = ifChanged");
  show_hide_c_operasi_anti_inkontinensia_urine_burch_kolposuspensi();
});

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
show_hide_c_operasi_anti_inkontinensia_urine_sling();
show_hide_c_operasi_anti_inkontinensia_urine_burch_kolposuspensi();
@endsection
