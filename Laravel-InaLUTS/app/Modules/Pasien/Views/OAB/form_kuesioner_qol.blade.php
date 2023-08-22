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
            'name' => 'score_1',
            'data' => [
                ['value' => $i, 'text' => $i]
            ],
            'no_text' => true,
        ], false);
        $tbl .= '<td align="center">'.$div.$choice.'<br><b>'.$i.'</b></div></td>'.PHP_EOL;
    }
    $tbl .= '<tr>'.PHP_EOL;

    $tbl .= '</table>'.PHP_EOL;

    FORM::row(':merge', $tbl);

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
function score_onCheck(i){
    const score = $('input[name="score_'+i+'"]:checked').val();
    //console.log(i+' = '+score);
    $('#span_score_'+i).html(score);

    let score_1 = parseInt($('input[name="score_1"]:checked').val());
    let score_2 = parseInt($('input[name="score_2"]:checked').val());
    let score_3 = parseInt($('input[name="score_3"]:checked').val());
    let score_4 = parseInt($('input[name="score_4"]:checked').val());
    if (isNaN(score_1)) score_1 = 0;
    if (isNaN(score_2)) score_2 = 0;
    if (isNaN(score_3)) score_3 = 0;
    if (isNaN(score_4)) score_4 = 0;
    //console.log(score_1+' '+score_2+' '+score_3+' '+score_4);
    $('#span_total_score').html(score_1 + score_2 + score_3 + score_4);
}

@for($i=1;$i<=4;$i++)
$('input[name=\"score_{{ $i }}\"]').on('ifChecked', function(){
    score_onCheck( {{ $i }} );
});
@endfor

// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');

score_onCheck(1);
score_onCheck(2);
score_onCheck(3);
score_onCheck(4);
@endsection
