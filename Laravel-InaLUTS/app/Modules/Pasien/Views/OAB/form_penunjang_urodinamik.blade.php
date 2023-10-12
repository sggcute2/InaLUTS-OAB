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

    //====================[ Begin Follow Up : Form OAB_penunjang_urodinamik ]===
    $ns = '';
    $temp = '
        Kapasitas kandung kemih
        Compliance
        Detrusor overactivity
        Detrusor overactivity incontinence
        Urodynamic stress urinary incontinence
        Obstruksi infravesical
        Detrusor underactivity
        Disfunctional Voiding
        DSD
        Neurogenic Bladder
        PVR
    ';
    $x = explode("\n", $temp);
    $buffer = [];
    $buffer[] = '<b>Tanggal</b>'
        .'<br>'
        .BS::datepicker([
            'name' => $ns.'pemeriksaan_urodinamik_ya_date',
            'required' => false,
        ], false);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));
            switch($field) {
                case 'kapasitas_kandung_kemih':
                case 'pvr':
                    $buffer[] = '<b>'.$caption.'</b>'
                        .'<br>'
                        .BS::number([
                            'name' => $ns.$field.'_1',
                            'inline' => true
                        ], false)
                        .' - '
                        .BS::number([
                            'name' => $ns.$field.'_2',
                            'inline' => true
                        ], false)
                        .' ml';
                    break;

                case 'compliance':
                    $buffer[] = '<b>'.$caption.'</b>'
                        .'<br>'
                        .BS::radio_array([
                                'name' => $ns.$field,
                                'data' => ['Normal', 'Tidak Normal'],
                            ], false);
                    break;

                case 'disfunctional_voiding':
                    $buffer[] = '<b>'.$caption.'</b>'
                        .'<br>'
                        .BS::radio_array([
                                'name' => $ns.$field,
                                'data' => ['Ya', 'Tidak', 'Tidak Diperiksa'],
                            ], false);
                    break;

                default :
                    $buffer[] = '<b>'.$caption.'</b>'
                        .'<br>'
                        .BS::radio_ya_tidak([
                            'name' => $ns.$field,
                        ], false);
                    break;
            }
        }
    }
    //======================[ End Follow Up : Form OAB_penunjang_urodinamik ]===

    FORM::row(
        'Pemeriksaan urodinamik',
        BS::radio_ya_tidak([
            'name' => 'pemeriksaan_urodinamik',
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_pemeriksaan_urodinamik_ya" class="indent1">'
        .implode('<br><br>', $buffer)
        .'</div>'
    );
    if (
        isset($default['pemeriksaan_urodinamik'])
        && $default['pemeriksaan_urodinamik'] == 'Ya'
    ) {
    } else {
        BS::jquery_ready("$('#div_pemeriksaan_urodinamik_ya').hide();");
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
