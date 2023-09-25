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

    //=========================[ Begin Follow Up : Form OAB_kuesioner_oabss ]===
    $ns = 'oabss_';
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
    FORM::row(':merge', $tbl);
    //===========================[ End Follow Up : Form OAB_kuesioner_oabss ]===

    //=========================[ Begin Follow Up : Form OAB_kuesioner_oabss ]===
    $ns = '';
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

    FORM::row(':merge', $tbl);

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
@php
$ns = '';
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

// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');

{{ $ns }}score_onCheck(1);
{{ $ns }}score_onCheck(2);
{{ $ns }}score_onCheck(3);
{{ $ns }}score_onCheck(4);
@endsection
