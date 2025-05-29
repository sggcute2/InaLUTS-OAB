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

    $a = [];
    $a[] = ['Over the past 4 weeks, how often did you feel sexual desire or interest?',
        [
            'Almost always or always = 5',
            'Most times (more than half the time) = 4',
            'Sometimes (about half the time) = 3',
            'A few times (less than half the time) = 2',
            'Almost never or never = 1',
        ]
    ];
    $a[] = ['Over the past 4 weeks, how often did you feel sexually aroused &quot;turned on&quot; during sexual activity or intercourse?',
        [
            'Almost always or always = 5',
            'Most times (more than half the time) = 4',
            'Sometimes (about half the time) = 3',
            'A few times (less than half the time) = 2',
            'Almost never or never = 1',
            'No sexual activity = 0',
        ]
    ];
    $a[] = ['Over the past 4 weeks, how often did maintain your lubrication (“wetness”) until completion of sexual activity/ intercourse?',
        [
            'Almost always or always = 5',
            'Most times (more than half the time) = 4',
            'Sometimes (about half the time) = 3',
            'A few times (less than half the time) = 2',
            'Almost never or never = 1',
            'No sexual activity = 0',
        ]
    ];
    $a[] = ['Over the past 4 weeks, when you had intercourse, how difficult was it for you to reach orgasm (climax)?',
        [
            'Not difficult = 5',
            'Slightly difficult = 4',
            'Difficult = 3',
            'Very difficult = 2',
            'Extremely difficult or impossible = 1',
            'No sexual activity = 0',
        ]
    ];
    $a[] = ['Over the past 4 weeks, how satisfied have you been overall with your sex life?',
        [
            'Very satisfied = 5',
            'Moderately satisfied = 4',
            'About equally satisfied and dissatisfied = 3',
            'Moderately dissatisfied = 2',
            'Very dissatisfied = 1',
        ]
    ];
    $a[] = ['Over the past 4 weeks how often did you experience pain or discomfort during vaginal penetration?',
        [
            'Almost never or never = 5',
            'A few times (less than half the time) = 4',
            'Sometimes (about half the time) = 3',
            'Most times (more than half the time) = 2',
            'Almost always or always = 1',
            'Did not attempt intercourse = 0',
        ]
    ];
    $div = '<div style="padding:1em">';
    $div2 = '<div style="width:300px;padding:1em">';
    $tbl  = '';
    $tbl .= '<table>'.PHP_EOL;
    $tbl .= '<tr align="center" style="font-weight:bold;border-bottom:solid 1px black">'.PHP_EOL;
    $tbl .= '<td>No.</td>'.PHP_EOL;
    $tbl .= '<td>Pertanyaan</td>'.PHP_EOL;
    $tbl .= '<td>Pilihan Jawaban</td>'.PHP_EOL;
    $tbl .= '</tr>'.PHP_EOL;
    $no = 0;
    foreach($a as $v){
        $tbl .= '<tr valign="top">'.PHP_EOL;
        $tbl .= '<td>'.$div.++$no.'.</div></td>'.PHP_EOL;
        $tbl .= '<td>'.$div2.'<i>'.$v[0].'</i></div></td>'.PHP_EOL;
        $choice = '';
        if (isset($v[1])) {
            $buffer_data = [];
            foreach($v[1] as $vdata){
                $x = explode('=', $vdata);
                $buffer_data[] = ['value' => trim($x[1]), 'text' => trim($x[0])];
            }
            $choice = BS::radio_array([
                'name' => 'score_'.$no,
                'data' => $buffer_data,
                'vertical' => true,
                'caption_italic' => true,
            ], false);
        }
        $tbl .= '<td>'.$div.$choice.'</div></td>'.PHP_EOL;
        $tbl .= '</tr>'.PHP_EOL;
    }
    $tbl .= '<tr align="center" style="font-weight:bold;border-top:solid 1px black">'.PHP_EOL;
    $tbl .= '<td></td>'.PHP_EOL;
    $tbl .= '<td align="right">Jumlah Skor</td>'.PHP_EOL;
    $tbl .= '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="span_total_score" style="font-weight:bold"></span></td>'.PHP_EOL;
    $tbl .= '</tr>'.PHP_EOL;
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

    let total_score = 0;
    @for($i=1;$i<=19;$i++)
    let score_{{ $i }} = parseInt($('input[name="score_{{ $i }}"]:checked').val());
    if (isNaN(score_{{ $i }})) score_{{ $i }} = 0;
    total_score += score_{{ $i }};
    @endfor

    $('#span_total_score').html(total_score);
}

@for($i=1;$i<=19;$i++)
$('input[name=\"score_{{ $i }}\"]').on('ifChecked', function(){
    score_onCheck( {{ $i }} );
});
@endfor

// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');

@for($i=1;$i<=19;$i++)
score_onCheck({{ $i }});
@endfor
@endsection
