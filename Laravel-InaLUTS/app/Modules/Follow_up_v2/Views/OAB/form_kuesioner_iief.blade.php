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
    $a[] = ['Bagaimana Anda menilai kepercayaan diri Anda bahwa Anda bisa mendapatkan dan mempertahankan ereksi?',
        [
            '1=Sangat rendah',
            '2=Rendah',
            '3=Cukup',
            '4=Tinggi',
            '5=Sangat tinggi',
        ]
    ];
    $a[] = ['Pada saat Anda ereksi setelah mengalami perangsangan seksual, seberapa sering penis Anda cukup keras untuk dapat penetrasi ke dalam pasangan Anda?',
        [
            '1=Tidak pernah atau hampir tidak pernah',
            '2=Beberapa kali (<50% waktu)',
            '3=Kadang-kadang (50% waktu)',
            '4=Sebagian besar waktu (>50% waktu)',
            '5=Selalu atau hampir selalu',
        ]
    ];
    $a[] = ['Pada saat berhubungan seksual, seberapa sering Anda dapat mempertahankan ereksi Anda setelah Anda melakukan penetrasi ke dalam pasangan Anda?',
        [
            '1=Tidak pernah atau hampir tidak pernah',
            '2=Beberapa kali (<50% waktu)',
            '3=Kadang-kadang (50% waktu)',
            '4=Sebagian besar waktu (>50% waktu)',
            '5=Selalu atau hampir selalu',
        ]
    ];
    $a[] = ['Pada saat hubungan seksual, seberapa sulitkah Anda mempertahankan ereksi untuk menyelesaikan hubungan seksual?',
        [
            '1=Sangat sulit sekali',
            '2=Sangat sulit',
            '3=Sulit',
            '4=Sedikit sulit',
            '5=Tidak sulit',
        ]
    ];
    $a[] = ['Ketika Anda mencoba berhubungan seksual, seberapa sering itu memuaskan Anda?',
        [
            '1=Tidak pernah atau hampir tidak pernah',
            '2=Beberapa kali (<50% waktu)',
            '3=Kadang-kadang (50% waktu)',
            '4=Sebagian besar waktu (>50% waktu)',
            '5=Selalu atau hampir selalu',
        ]
    ];
    $div = '<div style="padding:1em">';
    $div2 = '<div style="width:300px;padding:1em">';
    $tbl  = '';
    $tbl .= '<p>Dalam 6 bulan terakhir</p>';
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
        $tbl .= '<td>'.$div2.$v[0].'</div></td>'.PHP_EOL;
        $choice = '';
        if (isset($v[1])) {
            $buffer_data = [];
            foreach($v[1] as $vdata){
                $x = explode('=', $vdata);
                $buffer_data[] = ['value' => $x[0], 'text' => $x[1]];
            }
            $choice = BS::radio_array([
                'name' => 'score_'.$no,
                'data' => $buffer_data,
                'vertical' => true,
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

    $legend_arr = [
        ['1-7',   'DE berat'],
        ['8-11',  'DE sedang'],
        ['12-16', 'DE ringan-sedang'],
        ['17-21', 'DE ringan'],
        ['22-25', 'Tidak ED'],
    ];
    $tbl .= '<p><b>Jumlah Skor</b></p>'.PHP_EOL;
    $tbl .= '<table>'.PHP_EOL;
    foreach($legend_arr as $legend){
        $tbl .= '<tr>'.PHP_EOL;
        $tbl .= '<td>'.$legend[0].'</td>'.PHP_EOL;
        $tbl .= '<td> &nbsp; : &nbsp; </td>'.PHP_EOL;
        $tbl .= '<td>'.$legend[1].'</td>'.PHP_EOL;
        $tbl .= '</tr>'.PHP_EOL;
    }
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
    @for($i=1;$i<=5;$i++)
    let score_{{ $i }} = parseInt($('input[name="score_{{ $i }}"]:checked').val());
    if (isNaN(score_{{ $i }})) score_{{ $i }} = 0;
    total_score += score_{{ $i }};
    @endfor

    $('#span_total_score').html(total_score);
}

@for($i=1;$i<=5;$i++)
$('input[name=\"score_{{ $i }}\"]').on('ifChecked', function(){
    score_onCheck( {{ $i }} );
});
@endfor

// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');

@for($i=1;$i<=5;$i++)
score_onCheck({{ $i }});
@endfor
@endsection
