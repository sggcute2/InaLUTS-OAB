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

    //==============================================================[ OABSS ]===
    FORM::row(':header2', 'OABSS');
    $ns = 'oabss_';
    $field = 'oabss';
    $caption = 'OABSS';
    FORM::row(
        $caption,
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    //=========================[ Begin Follow Up : Form OAB_kuesioner_oabss ]===
    $a = [];
    $a[] = ['
        Frekuensi siang hari
        <br>
        Berapa kali biasanya Anda kencing, dari pagi
        <br>
        sampai akan tidur di malam hari?
      ',
        [
            ['value' => 0, 'text' => '&le; 7'],
            ['value' => 1, 'text' => '8-14'],
            ['value' => 2, 'text' => '&ge; 15'],
        ]
    ];
    $a[] = ['
        Frekuensi malam hari
        <br>
        Berapa kali biasanya Anda terbangun untuk kencing,
        <br>
        dari mulai tidur di malam hari sampai pagi hari?
    ',
        [
            ['value' => 0, 'text' => '0'],
            ['value' => 1, 'text' => '1'],
            ['value' => 2, 'text' => '2'],
            ['value' => 3, 'text' => '&ge; 3'],
        ]
    ];
    $a[] = ['
        Keadaan yang mendesak
        <br>
        Berapa sering Anda mengalami keinginan yang
        <br>
        mendadak untuk kencing yang sulit ditahan?
    ',
        [
            ['value' => 0, 'text' => 'Tidak pernah'],
            ['value' => 1, 'text' => '&lt; 1 dalam 1 minggu'],
            ['value' => 2, 'text' => '&ge; 1 dalam 1 minggu'],
            ['value' => 3, 'text' => 'sekali seminggu'],
            ['value' => 4, 'text' => '2-4 kali sehari'],
            ['value' => 5, 'text' => '5 kali sehari atau lebih'],
        ]
    ];
    $a[] = ['
        Keadaan yang mendesak, beser
        <br>
        Seberapa sering Anda mengompol karena sulit
        <br>
        menahan keinginan mendadak untuk kencing?
    ',
        [
            ['value' => 0, 'text' => 'Tidak pernah'],
            ['value' => 1, 'text' => '&lt; 1 dalam 1 minggu'],
            ['value' => 2, 'text' => '&ge; 1 dalam 1 minggu'],
            ['value' => 3, 'text' => 'sekali seminggu'],
            ['value' => 4, 'text' => '2-4 kali sehari'],
            ['value' => 5, 'text' => '5 kali sehari atau lebih'],
        ]
    ];
    $div = '<div style="padding:1em">';
    $tbl  = '';
    $tbl .= '<table>'.PHP_EOL;
    $tbl .= '<tr align="center" style="font-weight:bold;border-bottom:solid 1px black">'.PHP_EOL;
    $tbl .= '<td></td>'.PHP_EOL;
    $tbl .= '<td>Pertanyaan</td>'.PHP_EOL;
    $tbl .= '<td>Frekuensi</td>'.PHP_EOL;
    $tbl .= '<td> &nbsp; Skor &nbsp; </td>'.PHP_EOL;
    $tbl .= '</tr>'.PHP_EOL;
    $no = 0;
    foreach($a as $v){
        $tbl .= '<tr valign="top">'.PHP_EOL;
        $tbl .= '<td>'.$div.++$no.'.</div></td>'.PHP_EOL;
        $tbl .= '<td>'.$div.$v[0].'</div></td>'.PHP_EOL;
        $choice = '';
        if (isset($v[1])) {
            $choice = BS::radio_array([
                'name' => $ns.'score_'.$no,
                'data' => $v[1],
                'vertical' => true,
            ], false);
        }
        $tbl .= '<td>'.$div.$choice.'</div></td>'.PHP_EOL;
        $tbl .= '<td align="center">'.$div.'<span id="'.$ns.'span_score_'.$no.'" style="font-weight:bold"></span></div></td>'.PHP_EOL;
        $tbl .= '</tr>'.PHP_EOL;
    }
    $tbl .= '<tr align="center" style="font-weight:bold;border-top:solid 1px black">'.PHP_EOL;
    $tbl .= '<td></td>'.PHP_EOL;
    $tbl .= '<td></td>'.PHP_EOL;
    $tbl .= '<td>Jumlah Skor</td>'.PHP_EOL;
    $tbl .= '<td><span id="'.$ns.'span_total_score" style="font-weight:bold"></span></td>'.PHP_EOL;
    $tbl .= '</tr>'.PHP_EOL;
    $tbl .= '</table>'.PHP_EOL;
    //===========================[ End Follow Up : Form OAB_kuesioner_oabss ]===
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .$tbl
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    //================================================================[ QOL ]===
    FORM::row(':header2', 'QOL');
    $ns = 'qol_';
    $field = 'qol';
    $caption = 'QOL';
    FORM::row(
        $caption,
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    //===========================[ Begin Follow Up : Form OAB_kuesioner_qol ]===
    $div = '<div style="padding:1em">';
    $tbl  = '';
    $tbl .= '<table border="1">'.PHP_EOL;
    $tbl .= '<tr style="font-weight:bold">'.PHP_EOL;
    $tbl .= '<td>'.$div.'Kualitas Hidup</div></td>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Senang Sekali</div></td>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Senang</div></td>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Pada umumnya puas</div></td>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Campur: antara puas dan tidak</div></td>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Pada umumnya tidak puas</div></td>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Tidak senang</div></td>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Buruk sekali</div></td>'.PHP_EOL;
    $tbl .= '<tr>'.PHP_EOL;
    $tbl .= '<tr>'.PHP_EOL;
    $tbl .= '<td>'.$div.'Seandainya Anda harus menghabiskan sisa hidup dengan fungsi kencing seperti saat ini, bagaiman perasaan Anda?</div></td>'.PHP_EOL;
    for($i=0; $i<=6; $i++){
        $choice = BS::radio_array([
            'name' => $ns.'score_1',
            'data' => [
                ['value' => $i, 'text' => $i]
            ],
            'no_text' => true,
        ], false);
        $tbl .= '<td align="center">'.$div.$choice.'<br><b>'.$i.'</b></div></td>'.PHP_EOL;
    }
    $tbl .= '<tr>'.PHP_EOL;

    $tbl .= '</table>'.PHP_EOL;
    //=============================[ End Follow Up : Form OAB_kuesioner_qol ]===
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .$tbl
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    //======================================================[ Bladder Diary ]===
    FORM::row(':header2', 'Bladder Diary');
    $ns = 'bladder_diary_';
    //=================[ Begin Follow Up : Form OAB_kuesioner_bladder_diary ]===
    $a = [
        ['Intake cairan / 24 jam', 'intake_cairan'],
        ['Frekuensi kencing dalam 24 jam', 'frekuensi_kencing'],
        ['Nocturia', 'nocturia'],
        ['Porsi miksi', 'porsi_miksi'],
        ['Produksi urin / 24 jam', 'produksi_urin'],
        ['Urgency', 'urgency'],
        ['Inkontinensia urine', 'inkontinensia_urine'],
        ['Poliuria nocturnal', 'poliuria_nocturnal'],
    ];
    $UOM = [
        'intake_cairan' => 'ml',
        'porsi_miksi' => 'ml',
        'produksi_urin' => 'ml',
        'urgency' => 'x',
        'inkontinensia_urine' => 'x',
    ];
    $UOM2 = [
        'nocturia' => ' /malam',
    ];
    foreach($a as $av){
        $field = '';

        switch($av[1]){
            case 'intake_cairan':
            case 'frekuensi_kencing':
            case 'nocturia':
            case 'porsi_miksi':
            case 'produksi_urin':
            case 'urgency':
            case 'inkontinensia_urine':
                $uom = (isset($UOM[$av[1]])) ? $UOM[$av[1]] : '';
                $uom2 = (isset($UOM2[$av[1]])) ? $UOM2[$av[1]] : '';
                $field = BS::number([
                        'name' => $ns.$av[1].'_1',
                        'inline' => true,
                    ], false)
                    .' '.$uom
                    .' s/d '
                    .BS::number([
                        'name' => $ns.$av[1].'_2',
                        'inline' => true,
                    ], false).' '.$uom
                    .$uom2;
                break;

            case 'poliuria_nocturnal':
                $field = BS::radio_ya_tidak([
                    'name' => $ns.$av[1],
                ], false);
                break;
        }

        FORM::row($av[0], $field);
    }
    //=================[ Begin Follow Up : Form OAB_kuesioner_bladder_diary ]===

    //==================================================[ Efek Samping Obat ]===
    FORM::row(':header2', 'Efek Samping Obat');
    $temp = '
        Mulut Kering
        Mata Kering
        Konstipasi
        Gejala Voiding
        Gangguan Fungsi Kognitif
        Retensi Urine
        Hipertensi
        Gangguan Irama Jantung
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(' ', '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'with_blank' => true,
                    ], false)
            );
        }
    }

    //===============================[ Komplikasi Tindakan Invasive/Operasi ]===
    FORM::row(':header2', 'Komplikasi Tindakan Invasive/Operasi');
    $temp = '
        ISK;isk
        Hematuria;hematuria
        Gejala Voiding;gejala_voiding2
        Retensi Urine;retensi_urine2
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $x2 = explode(";", trim($v));
            $caption = $x2[0];
            $field = $x2[1];

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'with_blank' => true,
                    ], false)
            );
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

@php
$ns = 'oabss_';
@endphp
function {{ $ns }}score_onCheck(i){
    const score = $('input[name="{{ $ns }}score_'+i+'"]:checked').val();
    //console.log(i+' = '+score);
    $('#{{ $ns }}span_score_'+i).html(score);

    let score_1 = parseInt($('input[name="{{ $ns }}score_1"]:checked').val());
    let score_2 = parseInt($('input[name="{{ $ns }}score_2"]:checked').val());
    let score_3 = parseInt($('input[name="{{ $ns }}score_3"]:checked').val());
    let score_4 = parseInt($('input[name="{{ $ns }}score_4"]:checked').val());
    if (isNaN(score_1)) score_1 = 0;
    if (isNaN(score_2)) score_2 = 0;
    if (isNaN(score_3)) score_3 = 0;
    if (isNaN(score_4)) score_4 = 0;
    //console.log(score_1+' '+score_2+' '+score_3+' '+score_4);
    $('#{{ $ns }}span_total_score').html(score_1 + score_2 + score_3 + score_4);
}

@for($i=1;$i<=4;$i++)
$('input[name=\"{{ $ns }}score_{{ $i }}\"]').on('ifChecked', function(){
    {{ $ns }}score_onCheck( {{ $i }} );
});
@endfor
{{ $ns }}score_onCheck(1);
{{ $ns }}score_onCheck(2);
{{ $ns }}score_onCheck(3);
{{ $ns }}score_onCheck(4);

@endsection
