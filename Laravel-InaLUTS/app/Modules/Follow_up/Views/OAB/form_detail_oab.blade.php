@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}
  @php
    $div_header = '<div style="text-align:center;background:darkblue;padding:5px;font-weight:bold;color:white">';

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
                    ], false)
            );
        }
    }

    //==============================================[ Pemeriksaan Penunjang ]===
    FORM::row(':header2', 'Pemeriksaan Penunjang');
    $ns = 'pemeriksaan_penunjang_';
    $field = 'pemeriksaan_penunjang';
    $caption = 'Apakah ada tambahan pemeriksaan penunjang';
    $choice2 = '';
    $temp2 = '
        USG
        Uroflowmetri
        Pemeriksaan Laboratorium
        Bladder Diary
        UPP
        Urodinamik
        Sistoskopi
    ';
    $x2 = explode("\n", $temp2);
    foreach($x2 as $v2){
        if (trim($v2) != '') {
            $caption2 = trim($v2);
            $field2 = 'pemeriksaan_penunjang_'.strtolower(str_replace(' ', '_', $caption2));

            $temp_choice2 = '';
            switch($field2){
                case 'pemeriksaan_penunjang_usg':
                    //====[ Begin Follow Up : Form OAB_kuesioner_pemeriksaan_penunjang__usg ]===
                    $ns = 'pemeriksaan_penunjang_usg_';
                    $temp_choice2 .= '<b>USG (abdominal / transrektal)</b><br>';
                    $temp_choice2 .= BS::radio_array([
                        'name' => $ns.'usg',
                        'data' => ['Dilakukan', 'Tidak Dilakukan'],
                        'vertical' => true,
                        'toggle_div_by_value' => [
                            'Dilakukan' => [
                                    'id' => $ns.'usg_dilakukan__date',
                                    'class' => 'indent1',
                                    'html' => 'Tanggal : '
                                        .BS::datepicker([
                                            'name' => $ns.'usg_date',
                                            'required' => false,
                                        ], false),
                                ],
                        ],
                    ], false);
                    $temp_choice2 .= '<br><br>';
                    if (isset($default[$ns.'usg']) && $default[$ns.'usg'] == 'Dilakukan') {
                    } else {
                        BS::jquery_ready("$('#".$ns."usg_dilakukan__date').hide();");
                    }

                    $field3 = $ns.'ct_urografi';
                    $temp_choice2 .= '<b>CT Urografi</b><br>';
                    $temp_choice2 .= BS::radio_ya_tidak([
                        'name' => $ns.$field3,
                    ], false);
                    $temp_choice2 .= '<br><br>';

                    $temp_choice2 .= $div_header.'Ginjal</div>';
                    $temp_choice2 .= '<b>Kanan</b><br>';
                    $temp_choice2 .= '<div class="indent1"><b>Hidronefrosis</b></div>';
                    $temp_choice2 .= '<div class="indent1" style="margin-bottom:1em">';
                    $temp_choice2 .= BS::radio_array([
                        'name' => $ns.'ginjal__kanan__hidronefrosis',
                        'data' => ['Tidak', 'Ringan', 'Sedang', 'Berat'],
                    ], false);
                    $temp_choice2 .= '</div>';
                    $temp_choice2 .= '<div class="indent1"><b>Batu</b></div>';
                    $temp_choice2 .= '<div class="indent1" style="margin-bottom:1em">';
                    $temp_choice2 .= BS::radio_array([
                        'name' => $ns.'ginjal__kanan__batu',
                        'data' => ['Ada', 'Tidak'],
                    ], false);
                    $temp_choice2 .= '</div>';
                    $temp_choice2 .= '<b>Kiri</b><br>';
                    $temp_choice2 .= '<div class="indent1"><b>Hidronefrosis</b></div>';
                    $temp_choice2 .= '<div class="indent1" style="margin-bottom:1em">';
                    $temp_choice2 .= BS::radio_array([
                        'name' => $ns.'ginjal__kiri__hidronefrosis',
                        'data' => ['Tidak', 'Ringan', 'Sedang', 'Berat']
                    ], false);
                    $temp_choice2 .= '</div>';
                    $temp_choice2 .= '<div class="indent1"><b>Batu</b></div>';
                    $temp_choice2 .= '<div class="indent1">';
                    $temp_choice2 .= BS::radio_array([
                        'name' => $ns.'ginjal__kiri__batu',
                        'data' => ['Ada', 'Tidak']
                    ], false);
                    $temp_choice2 .= '</div>';

                    $temp_choice2 .= $div_header.'Buli</div>';
                    $a3 = [
                        'Batu',
                        'Divertikel',
                        'Massa intrabuli',
                    ];
                    foreach($a3 as $v3){
                        $caption3 = trim($v3);
                        $field3 = strtolower(str_replace(' ', '_', $caption3));
                        $temp_choice2 .= '<b>'.$caption3.'</b><br>';
                        $temp_choice2 .= BS::radio_array([
                            'name' => $ns.'buli__'.$field3,
                            'data' => ['Ada', 'Tidak']
                        ], false);
                        $temp_choice2 .= '<br><br>';
                    }
                    //====[ End Follow Up : Form OAB_kuesioner_pemeriksaan_penunjang__usg ]===
                    break;

                case 'pemeriksaan_penunjang_uroflowmetri':
                    //==================[ Begin Follow Up : Form OAB_penunjang_uroflowmetri ]===
                    $ns = 'pemeriksaan_penunjang_uroflowmetri_';
                    $temp3 = '
                        Voided volume;ml
                        Q max;ml / detik
                        Q ave;ml
                        PVR;ml
                        Voiding time;detik
                    ';
                    $x3 = explode("\n", $temp3);
                    foreach($x3 as $v3){
                        if (trim($v3) != '') {
                            $caption3 = trim($v3);
                            $x3_2 = explode(';', $caption3);
                            $caption3 = $x3_2[0];
                            $field3 = strtolower(str_replace(array(' ', '-'), '_', $x3_2[0]));
                            $uom3 = $x3_2[1];

                            $temp_choice2 .= '<b>'.$caption3.'</b><br>';
                            $temp_choice2 .= BS::radio_ya_tidak([
                                'name' => $ns.$field3,
                                'toggle_div' => true,
                            ], false);
                            $temp_choice2 .= '<br>';

                            $temp_choice2 .= '<div id="div_'.$ns.$field3.'_ya" class="indent1" style="margin-bottom:1em">';
                            $temp_choice2 .= 'Tanggal : ';
                            $temp_choice2 .= BS::datepicker([
                                'name' => $ns.$field3.'_ya_date',
                                'required' => false,
                            ], false);
                            $temp_choice2 .= '<br>';
                            $temp_choice2 .= BS::number([
                                'name' => $ns.$field3.'_ya',
                                'inline' => true
                            ], false);
                            $temp_choice2 .= ' '.$uom3;
                            $temp_choice2 .= '</div>';
                            if ($field3 != 'voiding_time') $temp_choice2 .= '<br>';

                            if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                            } else {
                                BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                            }
                        }
                    }
                    //====================[ End Follow Up : Form OAB_penunjang_uroflowmetri ]===
                    break;

                case 'pemeriksaan_penunjang_pemeriksaan_laboratorium':
                    /*
                    ob_start();
                    echo '<p class="pull-right">';
                    echo BS::button('Add New', $pemeriksaan_penunjang__pemeriksaan_laboratorium__add_action);
                    echo '</p><br><br>';
                    DT::view('pemeriksaan_penunjang__pemeriksaan_laboratorium');
                    $temp_choice2 = ob_get_contents();
                    ob_end_clean();
                    */
                    $temp_choice2 .= '<div style="padding:1em;background:lightgoldenrodyellow;font-weight:bold;">Under Construction</div>';
                    break;

                case 'pemeriksaan_penunjang_bladder_diary':
                    //=================[ Begin Follow Up : Form OAB_kuesioner_bladder_diary ]===
                    $ns = 'pemeriksaan_penunjang_bladder_diary_';
                    $a3 = [
                        ['Intake cairan / 24 jam', 'intake_cairan'],
                        ['Frekuensi kencing dalam 24 jam', 'frekuensi_kencing'],
                        ['Nocturia', 'nocturia'],
                        ['Porsi miksi', 'porsi_miksi'],
                        ['Produksi urin / 24 jam', 'produksi_urin'],
                        ['Urgency', 'urgency'],
                        ['Inkontinensia urine', 'inkontinensia_urine'],
                        ['Poliuria nocturnal', 'poliuria_nocturnal'],
                    ];
                    $UOM3 = [
                        'intake_cairan' => 'ml',
                        'porsi_miksi' => 'ml',
                        'produksi_urin' => 'ml',
                        'urgency' => 'x',
                        'inkontinensia_urine' => 'x',
                    ];
                    $UOM3_2 = [
                        'nocturia' => ' /malam',
                    ];
                    foreach($a3 as $av3){
                        $field3 = '';

                        switch($av3[1]){
                            case 'intake_cairan':
                            case 'frekuensi_kencing':
                            case 'nocturia':
                            case 'porsi_miksi':
                            case 'produksi_urin':
                            case 'urgency':
                            case 'inkontinensia_urine':
                                $uom3 = (isset($UOM3[$av3[1]])) ? $UOM3[$av3[1]] : '';
                                $uom3_2 = (isset($UOM3_2[$av3[1]])) ? $UOM3_2[$av3[1]] : '';
                                $field3 = BS::number([
                                        'name' => $ns.$av3[1].'_1',
                                        'inline' => true,
                                    ], false)
                                    .' '.$uom3
                                    .' s/d '
                                    .BS::number([
                                        'name' => $ns.$av3[1].'_2',
                                        'inline' => true,
                                    ], false).' '.$uom3
                                    .$uom3_2;
                                break;

                            case 'poliuria_nocturnal':
                                $field3 = BS::radio_ya_tidak([
                                    'name' => $ns.$av3[1],
                                ], false);
                                break;
                        }

                        $temp_choice2 .= '<b>'.$av3[0].'</b><br>';
                        $temp_choice2 .= '<div style="margin-bottom:1em;">';
                        $temp_choice2 .= $field3;
                        $temp_choice2 .= '</div>';
                    }
                    //=================[ Begin Follow Up : Form OAB_kuesioner_bladder_diary ]===
                    break;

                case 'pemeriksaan_penunjang_upp':
                    //===========================[ Begin Follow Up : Form OAB_penunjang_upp ]===
                    $ns = 'pemeriksaan_penunjang_upp_';
                    $temp_choice2 .= '<b>UPP</b><br>';
                    $temp_choice2 .= BS::radio_array([
                        'name' => $ns.'upp',
                        'data' => array(
                            'Dikerjakan',
                            'Tidak Dikerjakan',
                        ),
                        'vertical' => true,
                        'toggle_div_by_value' => [
                            'Dikerjakan' => [
                                'id' => $ns.'upp_dikerjakan',
                                'class' => 'indent1',
                                'html' => ''
                                    .'<div>'
                                    .'<b>maximal urethral pressure :</b> '
                                    .BS::number([
                                        'name' => $ns.'maximal_urethral_pressure',
                                        'inline' => true,
                                    ], false)
                                    .'</div>'
                                    .'<div style="margin-top:1em">'
                                    .'<b>functional urethral length :</b> '
                                    .BS::number([
                                        'name' => $ns.'functional_urethral_length',
                                        'inline' => true,
                                    ], false)
                                    .'</div>'
                            ],
                        ],
                        ], false
                    );
                    if (isset($default[$ns.'upp']) && $default[$ns.'upp'] == 'Dikerjakan') {
                    } else {
                        BS::jquery_ready("$('#{$ns}upp_dikerjakan').hide();");
                    }
                    //=============================[ End Follow Up : Form OAB_penunjang_upp ]===
                    break;

                case 'pemeriksaan_penunjang_urodinamik':
                    //====================[ Begin Follow Up : Form OAB_penunjang_urodinamik ]===
                    $ns = 'pemeriksaan_penunjang_urodinamik_';
                    $temp3 = '
                        Kapasitas kandung kemih
                        Compliance
                        Detrusor overactivity
                        Detrusor overactivity incontinence
                        Urodynamic stress urinary incontinence
                        Obstruksi infravesical
                        Detrusor underactivity
                        Disfunctional voiding
                        PVR
                    ';
                    $x3 = explode("\n", $temp3);
                    $buffer = [];
                    $buffer[] = '<b>Tanggal</b>'
                        .'<br>'
                        .BS::datepicker([
                            'name' => $ns.'pemeriksaan_urodinamik_ya_date',
                            'required' => false,
                        ], false);
                    foreach($x3 as $v3){
                        if (trim($v3) != '') {
                            $caption3 = trim($v3);
                            $field3 = strtolower(str_replace(array(' ', '-'), '_', $caption3));
                            switch($field3) {
                                case 'kapasitas_kandung_kemih':
                                case 'pvr':
                                    $buffer[] = '<b>'.$caption3.'</b>'
                                        .'<br>'
                                        .BS::number([
                                            'name' => $ns.$field3.'_1',
                                            'inline' => true
                                        ], false)
                                        .' - '
                                        .BS::number([
                                            'name' => $ns.$field3.'_2',
                                            'inline' => true
                                        ], false)
                                        .' ml';
                                    break;

                                case 'compliance':
                                    $buffer[] = '<b>'.$caption3.'</b>'
                                        .'<br>'
                                        .BS::radio_array([
                                                'name' => $ns.$field3,
                                                'data' => ['Normal', 'Tidak Normal'],
                                            ], false);
                                    break;

                                case 'disfunctional_voiding':
                                    $buffer[] = '<b>'.$caption3.'</b>'
                                        .'<br>'
                                        .BS::radio_array([
                                                'name' => $ns.$field3,
                                                'data' => ['Ya', 'Tidak', 'Tidak Diperiksa'],
                                            ], false);
                                    break;

                                default :
                                    $buffer[] = '<b>'.$caption3.'</b>'
                                        .'<br>'
                                        .BS::radio_ya_tidak([
                                            'name' => $ns.$field3,
                                        ], false);
                                    break;
                            }
                        }
                    }
                    $temp_choice2 .= implode('<br><br>', $buffer);
                    //======================[ End Follow Up : Form OAB_penunjang_urodinamik ]===
                    break;

                case 'pemeriksaan_penunjang_sistoskopi';
                    //====================[ Begin Follow Up : Form OAB_penunjang_sistoskopi ]===
                    $ns = 'pemeriksaan_penunjang_sistoskopi_';
                    $temp_choice2 .= '<b>Sistoskopi</b><br>';
                    $temp_choice2 .=
                        BS::radio_array([
                            'name' => $ns.'sistoskopi',
                            'data' => array(
                                'Dikerjakan',
                                'Tidak Dikerjakan',
                            ),
                            'vertical' => true,
                            'toggle_div_by_value' => [
                                'Dikerjakan' => [
                                    'id' => $ns.'sistoskopi_dikerjakan',
                                    'class' => 'indent1',
                                    'html' => ''
                                        .'<div>'
                                        .'<b>Mukosa buli :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'mukosa_buli',
                                            'data' => ['Hiperemis', 'Tidak'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Trabekulasi :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'trabekulasi',
                                            'data' => ['Ringan', 'Sedang', 'Berat'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Sakulasi Divertikel :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'sakulasi_divertikel',
                                            'data' => ['Ya', 'Tidak'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Kapasitas Buli :</b> '
                                        .BS::number([
                                            'name' => $ns.'kapasitas_buli',
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Batu :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'batu',
                                            'data' => ['Ya', 'Tidak'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Tumor :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'tumor',
                                            'data' => ['Ya', 'Tidak'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Lobus Medius :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'lobus_medius',
                                            'data' => ['Tinggi', 'Tidak Tinggi'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Kissing Lobe :</b><br>'
                                        .BS::radio_array([
                                            'name' => $ns.'kissing_lobe',
                                            'data' => ['Ya', 'Tidak'],
                                            'vertical' => true,
                                            'toggle_div_by_value' => [
                                                'Ya' => [
                                                        'id' => $ns.'kissing_lobe_ya',
                                                        'class' => 'indent1',
                                                        'html' => ''
                                                            .BS::number([
                                                                'name' => $ns.'kissing_lobe_ya',
                                                                'required' => false,
                                                                'inline' => true,
                                                            ], false)
                                                            .' cm',
                                                    ],
                                            ],
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Muara Ureter :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'muara_ureter',
                                            'data' => ['Normal', 'Tidak Normal'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Urethra :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'urethra',
                                            'data' => ['Ya', 'Tidak'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>MUE :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'mue',
                                            'data' => ['Stenosis', 'Tidak'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                        .'<div style="margin-top:1em">'
                                        .'<b>Lichen Schlerosis :</b> '
                                        .BS::radio_array([
                                            'name' => $ns.'lichen_schlerosis',
                                            'data' => ['Ya', 'Tidak'],
                                            'inline' => true,
                                        ], false)
                                        .'</div>'
                                ],
                            ],
                            ], false
                        );
                    if (isset($default[$ns.'sistoskopi']) && $default[$ns.'sistoskopi'] == 'Dikerjakan') {
                    } else {
                        BS::jquery_ready("$('#{$ns}sistoskopi_dikerjakan').hide();");
                    }
                    if (isset($default[$ns.'kissing_lobe']) && $default[$ns.'kissing_lobe'] == 'Ya') {
                    } else {
                        BS::jquery_ready("$('#{$ns}kissing_lobe_ya').hide();");
                    }
                    //======================[ End Follow Up : Form OAB_penunjang_sistoskopi ]===
                    break;
            }

            $choice2 .= '<b>'.$caption2.'</b><br>';
            $choice2 .= BS::radio_ya_tidak([
                'name' => $field2,
                'toggle_div' => true,
            ], false);
            $choice2 .= '<div id="div_'.$field2.'_ya" class="indent2">';
            $choice2 .= $temp_choice2;
            $choice2 .= '</div>';
            $choice2 .= '<br><br>';

            if (isset($default[$field2]) && $default[$field2] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field2}_ya').hide();");
            }
        }
    }
    FORM::row(
        $caption,
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .$choice2
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
    }

    //====================================================[ Terapi Lanjutan ]===
    FORM::row(':header2', 'Terapi Lanjutan');
    $ns = 'follow_up_terapi_';
    $field = 'follow_up_terapi';
    $caption = 'Apakah ada follow up terapi';
    $choice2 = '';
    $temp2 = '
        Modifikasi Gaya Hidup
        Non-Operatif
        Medikamentosa
        Rehabilitasi
        Operatif
    ';
    $x2 = explode("\n", $temp2);
    foreach($x2 as $v2){
        if (trim($v2) != '') {
            $caption2 = trim($v2);
            $field2 = 'terapi_'.strtolower(str_replace(array(' ', '-'), '_', $caption2));

            $temp_choice2 = '';
            switch($field2){
                case 'terapi_modifikasi_gaya_hidup':
                    //============[ Begin Follow Up : Form OAB_terapi_modifikasi_gaya_hidup ]===
                    $ns = 'terapi_modifikasi_gaya_hidup_';
                    $temp_choice2 .= '<b>Tanggal</b><br>';
                    $temp_choice2 .= BS::datepicker([
                        'name' => $ns.'terapi_date',
                    ], false);
                    $temp_choice2 .= '<br>';

                    $temp3 = '
                    Menurunkan berat badan;menurunkan_berat_badan
                    Penilaian jenis dan jumlah asupan cairan;penilaian_jenis
                    Bladder training;bladder_training
                    Stop merokok;stop_merokok
                    Management stress;management_stress
                    Manajemen komorbid (termasuk konstipasi, PPOK, asma, dll);manajemen_komorbid
                    ';
                    $x3 = explode("\n", $temp3);
                    foreach($x3 as $v3){
                        if (trim($v3) != '') {
                            $x3_2 = explode(';', trim($v3));
                            $caption3 = trim($x3_2[0]);
                            $field3 = trim($x3_2[1]);

                            $temp_choice2 .= '<b>'.$caption3.'</b><br>';
                            $temp_choice2 .= BS::radio_ya_tidak([
                                'name' => $ns.$field3,
                                'toggle_div' => true,
                            ], false);

                            if ($field3 == 'bladder_training') {
                                $a3 = [
                                    'Timed Voiding',
                                    'Prompt Voiding',
                                    'Urge Suppression Strategies',
                                ];
                                $buffer = [];
                                foreach($a3 as $va3){
                                    $field_va3 = strtolower(
                                        str_replace(array(' ', '-'), '_', $va3)
                                    );

                                    $ext3 = '';
                                    if ($field_va3 == 'timed_voiding') {
                                        $ext3 .= '<div id="div_c_bladder_training_timed_voiding" class="indent1">';
                                        $ext3 .= BS::checkbox([
                                            'name' => $ns.'c_bladder_training_timed_voiding_berkemih_spontan',
                                            'caption' => 'Berkemih Spontan',
                                        ], false);
                                        $ext3 .= BS::checkbox([
                                            'name' => $ns.'c_bladder_training_timed_voiding_katerisasi',
                                            'caption' => 'Katerisasi',
                                        ], false);
                                        $ext3 .= '</div>';
                                    }

                                    $buffer[] = BS::checkbox([
                                        'name' => $ns.'c_'.$field.'_'.$field_va3,
                                        'caption' => $va3,
                                    ], false).$ext3;
                                }

                                $temp_choice2 .=
                                    '<div id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .implode('', $buffer)
                                    .'</div>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            } else {
                                $temp_choice2 .=
                                    '<span id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .'</span>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            }

                            $temp_choice2 .= '<br><br>';
                        }
                    }
                    //==============[ End Follow Up : Form OAB_terapi_modifikasi_gaya_hidup ]===
                    break;

                case 'terapi_non_operatif':
                    //=====================[ Begin Follow Up : Form OAB_terapi_non_operatif ]===
                    $ns = 'terapi_non_operatif_';
                    $temp3 = '
                    Tatalaksana non operatif;tatalaksana_non_operatif
                    ';
                    $x3 = explode("\n", $temp3);
                    foreach($x3 as $v3){
                        if (trim($v3) != '') {
                            $x3_2 = explode(';', trim($v3));
                            $caption3 = trim($x3_2[0]);
                            $field3 = trim($x3_2[1]);

                            $temp_choice2 .= '<b>'.$caption3.'</b><br>';
                            $temp_choice2 .=
                                BS::radio_ya_tidak([
                                    'name' => $ns.$field3,
                                    'toggle_div' => in_array($field3, [
                                        'tatalaksana_non_operatif',
                                    ]),
                                ], false);

                            if ($field3 == 'tatalaksana_non_operatif') {
                                $a3 = [
                                    'Kateter menetap',
                                    'Kateter berkala',
                                    'Penggunaan diapers',
                                    'Penile clamp',
                                    'Kondom kateter',
                                ];
                                $buffer = [];
                                foreach($a3 as $va3){
                                    $field_va3 = strtolower(
                                        str_replace(array(' ', '-'), '_', $va3)
                                    );

                                    $buffer[] = '<div style="margin-bottom:1em">'
                                        .$va3.' : '
                                        .BS::radio_ya_tidak([
                                            'name' => $ns.$field_va3,
                                        ], false)
                                        .'</div>';
                                }

                                $temp_choice2 .=
                                    '<div id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .implode('', $buffer)
                                    .'</div>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            } else if ($field3 == 'ptns') {
                                $a3 = [
                                    'Frekuensi;x/minggu',
                                    'Durasi;x',
                                ];
                                $buffer = [];
                                foreach($a3 as $va3){
                                    $xa3 = explode(';', trim($va3));
                                    $caption_va3 = trim($xa3[0]);
                                    $ext_va3 = trim($xa3[1]);
                                    $field_va3 = strtolower(
                                        str_replace(array(' ', '-'), '_', $caption_va3)
                                    );

                                    $buffer[] = '<div style="margin-bottom:1em">'.$caption_va3.' : '.BS::number([
                                        'name' => $ns.$field3.'_'.$field_va3,
                                        'caption' => $caption_va3,
                                        'inline' => true,
                                    ], false).' '.$ext_va3.'</div>';
                                }

                                $temp_choice2 .=
                                    '<div id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .implode('', $buffer)
                                    .'</div>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            } else {
                                $temp_choice2 .=
                                    '<div id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .'</div>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            }
                        }
                    }
                    //=======================[ End Follow Up : Form OAB_terapi_non_operatif ]===
                    break;

                case 'terapi_medikamentosa':
                    //====================[ Begin Follow Up : Form OAB_terapi_medikamentosa ]===
                    $ns = 'terapi_medikamentosa_';
                    $field3 = $ns.'medikamentosa';
                    $temp_choice2 .= '<b>Medikamentosa</b><br>';
                    $temp_choice2 .=
                        BS::radio_ya_tidak([
                            'name' => $field3,
                            'toggle_div' => true,
                        ], false);

                    $temp_choice2 .=
                        '<div id="div_'.$field3.'_ya" class="indent1">'
                        .BS::radio_array([
                            'name' => $field3.'_ya',
                            'data' => array(
                                'Teratur',
                                'Tidak Teratur',
                            ),
                            ], false
                        )
                        .'</div>';

                    if (isset($default[$field3]) && $default[$field3] == 'Ya') {
                    } else {
                        BS::jquery_ready("$('#div_{$field3}_ya').hide();");
                    }

                    $temp_choice2 .= $div_header.'Anti Muskarinik</div>';
                    $field3 = $ns.'solifenacin';
                    $temp_choice2 .= '<b>Solifenacin</b><br>';
                    $temp_choice2 .=
                        BS::radio_ya_tidak([
                            'name' => $field3,
                            'toggle_div' => true,
                        ], false);

                    $temp_choice2 .=
                        '<div id="div_'.$field3.'_ya" class="indent1">'
                        .BS::radio_array([
                            'name' => $field3.'_ya',
                            'data' => array(
                                '5 mg',
                                '10 mg',
                            ),
                            ], false
                        )
                        .'</div><br>';

                    if (isset($default[$field3]) && $default[$field3] == 'Ya') {
                    } else {
                        BS::jquery_ready("$('#div_{$field3}_ya').hide();");
                    }

                    $field3 = $ns.'imidafenacin';
                    $temp_choice2 .= '<b>Imidafenacin</b><br>';
                    $temp_choice2 .=
                        BS::radio_ya_tidak([
                            'name' => $field3,
                            'toggle_div' => true,
                        ], false);

                    $temp_choice2 .=
                        '<div id="div_'.$field3.'_ya" class="indent1">'
                        .BS::number([
                            'name' => $field3.'_ya',
                            'inline' => true,
                            ], false
                        )
                        .' dosis'
                        .'</div><br>';

                    if (isset($default[$field3]) && $default[$field3] == 'Ya') {
                    } else {
                        BS::jquery_ready("$('#div_{$field3}_ya').hide();");
                    }

                    $field3 = $ns.'tolterodinepropiverine';
                    $temp_choice2 .= '<b>Tolterodinepropiverine</b><br>';
                    $temp_choice2 .=
                        BS::radio_ya_tidak([
                            'name' => $field3,
                            'toggle_div' => true,
                        ], false);

                    $temp_choice2 .=
                        '<div id="div_'.$field3.'_ya" class="indent1">'
                        .BS::number([
                            'name' => $field3.'_ya',
                            'inline' => true,
                            ], false
                        )
                        .' dosis'
                        .'</div><br>';

                    if (isset($default[$field3]) && $default[$field3] == 'Ya') {
                    } else {
                        BS::jquery_ready("$('#div_{$field3}_ya').hide();");
                    }

                    $temp_choice2 .= $div_header.'B3 Agonis</div>';
                    $field3 = $ns.'mirabegron';
                    $temp_choice2 .= '<b>Mirabegron</b><br>';
                    $temp_choice2 .=
                        BS::radio_ya_tidak([
                            'name' => $field3,
                            'toggle_div' => true,
                        ], false);

                    $temp_choice2 .=
                        '<div id="div_'.$field3.'_ya" class="indent1">'
                        .BS::radio_array([
                            'name' => $field3.'_ya',
                            'data' => array(
                                '25 mg',
                                '50 mg',
                            ),
                            ], false
                        )
                        .'</div><br>';

                    if (isset($default[$field3]) && $default[$field3] == 'Ya') {
                    } else {
                        BS::jquery_ready("$('#div_{$field3}_ya').hide();");
                    }

                    $field3 = $ns.'flavoxate';
                    $temp_choice2 .= '<b>Flavoxate</b><br>';
                    $temp_choice2 .=
                        BS::radio_ya_tidak([
                            'name' => $field3,
                        ], false);

                    // End Follow Up : Form OAB_terapi_medikamentosa
                    //======================[ End Follow Up : Form OAB_terapi_medikamentosa ]===
                    break;

                case 'terapi_rehabilitasi':
                    //=====================[ Begin Follow Up : Form OAB_terapi_rehabilitasi ]===
                    $ns = 'terapi_rehabilitasi_';
                    $temp_choice2 .= '<b>Tanggal</b><br>';
                    $temp_choice2 .=
                        BS::datepicker([
                            'name' => $ns.'terapi_date',
                        ], false);

                    $temp3 = '1,2,3,4,5';
                    $temp_choice2 .= '<div style="padding:1em 0"><b>Penilaian otot dasar panggul</b></div>';
                    $temp_choice2 .= 'Oxford '.BS::select2([
                        'name' => $ns.'penilaian_otot_dasar_panggul',
                        'data' => explode(',', $temp3),
                        'with_blank' => true,
                        'inline' => true,
                        ], false);
                    $temp_choice2 .= '<br><br>';

                    $temp3 = '
                    Biofeedback;biofeedback
                    Latihan penguatan otot dasar panggul;latihan_penguatan_otot_dasar_panggul
                    Latihan relaksasi otot dasar panggul;latihan_relaksasi_otot_dasar_panggul
                    Kursi magnetic;kursi_magnetic
                    PTNS;ptns
                    ';
                    $x3 = explode("\n", $temp3);
                    foreach($x3 as $v3){
                        if (trim($v3) != '') {
                            $x3_2 = explode(';', trim($v3));
                            $caption3 = trim($x3_2[0]);
                            $field3 = trim($x3_2[1]);

                            $temp_choice2 .= '<b>'.$caption3.'</b><br>';
                            $temp_choice2 .=
                                BS::radio_ya_tidak([
                                    'name' => $ns.$field3,
                                    'toggle_div' => in_array($field3, [
                                        'biofeedback',
                                        'ptns',
                                    ]),
                                ], false);

                            if ($field3 == 'biofeedback') {
                                $a3 = [
                                    'Max Power;',
                                    'Durasi;detik',
                                ];
                                $buffer = [];
                                foreach($a3 as $va3){
                                    $xa3 = explode(';', trim($va3));
                                    $caption_va3 = trim($xa3[0]);
                                    $ext_va3 = trim($xa3[1]);
                                    $field_va3 = strtolower(
                                        str_replace(array(' ', '-'), '_', $caption_va3)
                                    );

                                    $buffer[] = '<div style="margin-bottom:1em">'.$caption_va3.' : '.BS::number([
                                        'name' => $ns.$field3.'_'.$field_va3,
                                        'caption' => $caption_va3,
                                        'inline' => true,
                                    ], false).' '.$ext_va3.'</div>';
                                }

                                $temp_choice2 .=
                                    '<div id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .implode('', $buffer)
                                    .'</div>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            } else if ($field3 == 'ptns') {
                                $a3 = [
                                    'Frekuensi;x/minggu',
                                    'Durasi;x',
                                ];
                                $buffer = [];
                                foreach($a3 as $va3){
                                    $xa3 = explode(';', trim($va3));
                                    $caption_va3 = trim($xa3[0]);
                                    $ext_va3 = trim($xa3[1]);
                                    $field_va3 = strtolower(
                                        str_replace(array(' ', '-'), '_', $caption_va3)
                                    );

                                    $buffer[] = '<div style="margin-bottom:1em">'.$caption_va3.' : '.BS::number([
                                        'name' => $ns.$field3.'_'.$field_va3,
                                        'caption' => $caption_va3,
                                        'inline' => true,
                                    ], false).' '.$ext_va3.'</div>';
                                }

                                $temp_choice2 .=
                                    '<div id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .implode('', $buffer)
                                    .'</div>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            } else {
                                $temp_choice2 .=
                                    '<div id="div_'.$ns.$field3.'_ya" class="indent1">'
                                    .'</div>';
                                $temp_choice2 .= '<br>';

                                if (isset($default[$ns.$field3]) && $default[$ns.$field3] == 'Ya') {
                                } else {
                                    BS::jquery_ready("$('#div_{$ns}{$field3}_ya').hide();");
                                }
                            }

                            $temp_choice2 .= '<br>';
                        }
                    }
                    //=======================[ End Follow Up : Form OAB_terapi_rehabilitasi ]===
                    break;

                case 'terapi_operatif':
                    break;
            }

            $choice2 .= '<b>'.$caption2.'</b><br>';
            $choice2 .= BS::radio_ya_tidak([
                'name' => $field2,
                'toggle_div' => true,
            ], false);
            $choice2 .= '<div id="div_'.$field2.'_ya" class="indent2">';
            $choice2 .= $temp_choice2;
            $choice2 .= '</div>';
            $choice2 .= '<br><br>';

            if (isset($default[$field2]) && $default[$field2] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field2}_ya').hide();");
            }
        }
    }
    FORM::row(
        $caption,
        BS::radio_ya_tidak([
            'name' => $field,
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_'.$field.'_ya" class="indent1">'
        .$choice2
        .'</div>'
    );
    if (isset($default[$field]) && $default[$field] == 'Ya') {
    } else {
        BS::jquery_ready("$('#div_{$field}_ya').hide();");
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

// Functions
@php
$ns = 'terapi_modifikasi_gaya_hidup_';
@endphp
function show_hide_c_bladder_training_timed_voiding(){
  const len = ($('input[name="{{ $ns }}c_follow_up_terapi_timed_voiding"]:checked').length !== 0);
  //console.log("len = " + len);
  if (len == '1') {
    $('#div_c_bladder_training_timed_voiding').show();
  } else {
    $('#div_c_bladder_training_timed_voiding').hide();
  }
}

// Behaviours
$('input[name="{{ $ns }}c_follow_up_terapi_timed_voiding"]').on('ifChanged', function(){
  //console.log("{{ $ns }}c_follow_up_terapi_timed_voiding = ifChanged");
  show_hide_c_bladder_training_timed_voiding();
});

// Init
show_hide_c_bladder_training_timed_voiding();

@endsection
