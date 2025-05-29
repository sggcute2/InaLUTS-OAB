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

    //===========================[ Begin Follow Up : Form OAB_kuesioner_qol ]===
    $ns = '';
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

    FORM::row(':merge', $tbl);

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
