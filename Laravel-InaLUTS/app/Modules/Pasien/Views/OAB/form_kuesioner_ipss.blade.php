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

    //==========================[ Begin Follow Up : Form OAB_kuesioner_ipss ]===
    $questions = array(
        'Selama sebulan terakhir, seberapa sering Anda merasa tidak lampias saat selesai berkemih?',
        'Selama sebulan terakhir, seberapa sering Anda harus kembali kencing dalam waktu kurang dari 2 jam setelah selesai berkemih?',
        'Selama sebulan terakhir, seberapa sering Anda mendapatkan bahwa Anda sulit menahan kencing?',
        'Seberapa sering Anda berhenti dan mulai lagi beberapa kali saat buang air kecil (Intermitensi)?',
        'Selama sebulan terakhir, seberapa sering pancaran kencing Anda lemah?',
        'Selama sebulan terakhir, seberapa sering Anda harus mengejan untuk mulai berkemih?',
        'Selama sebulan terakhir, seberapa sering Anda harus bangun untuk berkemih sejak mulai tidur pada malam hari hingga bangun di pagi hari?',
    );
    $options = array(
	    'Tidak Pernah',
	    'Kurang dari sekali dalam lima kali',
	    'Kurang dari setengah',
	    'Kadang-kadang (sekitar 50%)',
	    'Lebih dari setengah',
	    'Hampir selalu',
    );
    $ns = '';
    $div = '<div style="padding:1em">';
    //$tbl  = '<div style="border:solid 1px red;width:400px;overflow-x:auto;padding-right:1em">';
    $tbl  = '<div>';
    $tbl .= '<table border="1" width="800">'.PHP_EOL;
    $tbl .= '<tr style="font-weight:bold">'.PHP_EOL;
    $tbl .= '<td width="450">'.$div.'</div></td>'.PHP_EOL;
    foreach($options as $option){
        $tbl .= '<td width="50">'.$div.$option.'</div></td>'.PHP_EOL;
    }
    $tbl .= '<td width="50">'.$div.'Skor</div></td>'.PHP_EOL;
    $tbl .= '</tr>'.PHP_EOL;
    foreach($questions as $idx_question => $question){
        $tbl .= '<tr>'.PHP_EOL;
        $tbl .= '<td>'.$div.$question.'</div></td>'.PHP_EOL;
        foreach($options as $idx_option => $option){
            $choice = BS::radio_array([
                'name' => $ns.'score_'.($idx_question+1),
                'data' => [
                    ['value' => ($idx_option), 'text' => ($idx_option)]
                ],
                'no_text' => true,
            ], false);
            $tbl .= '<td align="center">'.$div.$choice.'<br><b>'.''/*($idx_question+1)*/.'</b></div></td>'.PHP_EOL;
        }
        $tbl .= '<td align="center">'.$div.'<span id="span__'.$ns.'score_'.($idx_question+1).'"></span></div></td>'.PHP_EOL;
        $tbl .= '</tr>'.PHP_EOL;
    }

    $tbl .= '<tr style="font-weight:bold">'.PHP_EOL;
    $tbl .= '<td colspan="7" align="right">'.$div.'Jumlah Skor</div></td>'.PHP_EOL;
    $tbl .= '<td align="center">'.$div.'<span id="span_total_score" style="font-weight:bold"></span></div></td>'.PHP_EOL;
    $tbl .= '</tr>'.PHP_EOL;
    $tbl .= '</table></div>'.PHP_EOL;

    $legend_arr = [
        ['0-7',   'Gejala ringan'],
        ['8-19',  'Gejala sedang'],
        ['20-35', 'Gejala berat'],
    ];
    $tbl .= '<br>'.PHP_EOL;
    $tbl .= '<table>'.PHP_EOL;
    foreach($legend_arr as $legend){
        $tbl .= '<tr>'.PHP_EOL;
        $tbl .= '<td>'.$legend[0].'</td>'.PHP_EOL;
        $tbl .= '<td> &nbsp; : &nbsp; </td>'.PHP_EOL;
        $tbl .= '<td>'.$legend[1].'</td>'.PHP_EOL;
        $tbl .= '</tr>'.PHP_EOL;
    }
    $tbl .= '</table>'.PHP_EOL;

    //============================[ End Follow Up : Form OAB_kuesioner_ipss ]===

    FORM::row(':merge', $tbl);

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Functions
function {{ $ns }}score_onCheck(name, v){
    console.log(name+' = '+v);
    $('#span__'+name).text(v);

    let total_score = 0;
    @for($i=1;$i<=7;$i++)
    let score_{{ $i }} = parseInt($('input[name="score_{{ $i }}"]:checked').val());
    if (isNaN(score_{{ $i }})) score_{{ $i }} = 0;
    total_score += score_{{ $i }};
    @endfor

    $('#span_total_score').html(total_score);
    console.log('total_score = '+total_score);
}

// Behaviour
@foreach($questions as $idx_question => $question)
$('input[name="{{ $ns }}score_{{ $idx_question + 1 }}"]').on('ifChecked', function(){
    /* {{ $ns }}score_onCheck(  ); */
    //console.log($(this).attr('name')+' = '+$(this).val());
    {{ $ns }}score_onCheck($(this).attr('name'), $(this).val());
});
@endforeach

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
@foreach($questions as $idx_question => $question)
{{ $ns }}score_onCheck('score_{{ $idx_question + 1 }}', {{ intval($default['score_'.($idx_question + 1)]) }});
@endforeach

@endsection
