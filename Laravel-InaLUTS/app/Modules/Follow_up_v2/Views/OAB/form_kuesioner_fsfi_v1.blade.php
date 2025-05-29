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
    $a[] = ['Selama 4 minggu terakhir, seberapa sering Anda merasa hasrat seksual atau keinginan untuk berhubungan seksual ?',
        [
            '5=Hampir selalu atau selalu dalam 4 minggu ini',
            '4=Sering sekali ( lebih dari separuh waktu) dalam 4 minggu ini',
            '3=Kadang-kadang ( sekitar separuh waktu ) dalam 4 minggu ini',
            '2=Beberapa kali ( kurang dari separuhnya) dalam 4 minggu ini',
            '1=Hampir tidak pernah atau tidak pernah dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, bagaimana Anda menilai tingkat ( derajat ) hasrat seksual alau keinginan untuk berhubungan seksual ?',
        [
            '5=Sangal tinggi dalam 4 minggu ini',
            '4=Tinggi dalam 4 minggu ini',
            '3=Sedang dalam 4 minggu ini',
            '2=Rendah dalam 4 minggu ini',
            '1=Sangat rendah alau tidak ada sama sekali dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa sering Anda merasa terangsang ("dalam menikmati hubungan seksual") selama aktivitas seksual atau hubungan intim ?',
        [
            '0=Tidak ada aktivitas seksual dalam',
            '5=Hampir selalu atau selalu dalam 4 minggu ini',
            '4=Sering kali ( lebih dari separuh waktu ) dalam 4 minggu ini',
            '3=Kadang-kadang ( sekilar separuh waktu ) dalam 4 minggu ini',
            '2=Beberapa kali ( kurang dari separuhnya) dalam 4 minggu ini',
            '1=Hampir tidak pernah atau tidak pernah dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, bagaimana Anda menilai tingkat gairah seksual ("dalam menikmati hubungan seksual") selama aktivitas seksual atau hubungan intim?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Sangal tinggi',
            '4=Tinggi',
            '3=Sedang',
            '2=Rendah',
            '1=Sangat rendah atau tidak ada sama sekali',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa yakin anda akan menjadi terangsang secara seksual selama aktivitas seksual atau hubungan intim ?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Memiliki keyakinan yang sangat tinggi akan menjadi terangsang selama hubungan seksual',
            '4=Memiliki keyakinan akan menjadi terangsang selama hubungan seksual',
            '3=Memiliki keyakinan yang sedang akan menjadi terangsang selama hubungan seksual',
            '2=Memiliki keyakinan yang kurang akan menjadi terangsang selama hubungan seksual',
            '1=Memiliki keyakinan yang sangat rendah atau tidak percaya akan menjadi terangsang selama hubungan seksual',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa sering Anda puas dengan gairah Anda (kegembiraan) selama aktivitas seksual atau hubungan intim ?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Hampir selalu atau selalu dalam 4 minggu ini',
            '4=Sering kali ( lebih dari separuh waktu ) dalam 4 minggu ini',
            '3=Kadang-kadang ( sekitar separuh waktu ) dalam 4 minggu ini',
            '2=Beberapa kali ( kurang dari separuhnya) dalam 4 minggu ini',
            '1=Hampir tidak pernah atau tidak pernah dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa sering kemaluan Anda menjadi basah selama aktivitas seksual atau hubungan intim?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Hampir selalu atau selalu dalam 4 minggu ini',
            '4=Sering kali (lebih dari separuh waktu) dalam 4 minggu ini',
            '3=Kadang-kadang (sekitar separuh waktu) dalam 4 minggu ini',
            '2=Beberapa kali (kurang dari separuhnya) dalam 4 minggu ini',
            '1=Hampir tidak pernah atau tidak pernah dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa sulitkah kemaluan Anda menjadi basah selama aktivitas seksual atau hubungan intim?',
        [
            '0=Tidak ada aktivitas seksual',
            '1=Sangat sulit atau tidak mungkin',
            '2=Sangat sulit dalam 4 minggu ini',
            '3=Sulit dalam 4 minggu ini',
            '4=Sedikit sulit dalam 4 minggu ini',
            '5=Tidak sulit dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir. seberapa sering Anda dapat mempertahankan kemaluan anda tetap basah sampai selesai aktivitas seksual atau hubungan intim?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Hampir selalu atau selalu dalam 4 minggu ini',
            '4=Sering kali (lebih dari separuh waktu) dalam 4 minggu ini',
            '3=Kadang-kadang (sekitar separuh waktu) dalam 4 minggu ini',
            '2=Beberapa kali (kurang dari separuhnya) dalam 4 minggu ini',
            '1=Hampir tidak pernah atau tidak pernah dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa sulitkah anda untuk mempertahankan kemaluan anda tetap basah sampai selesai aktivitas seksual atau hubungan intim?',
        [
            '0=Tidak ada aktivitas seksual',
            '1=Sangat sulit atau tidak mungkin dalam 4 minggu ini',
            '2=Sangat sulit dalam 4 minggu ini',
            '3=Sulit dalam 4 minggu ini',
            '4=Sedikit sulit dalam 4 minggu ini',
            '5=Tidak sulit dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, ketika Anda mendapat rangsangan seksual atau sedang berhubungan intim, seberapa sering Anda mencapai orgasme (klimaks)?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Hampir selalu atau selalu dalam 4 minggu ini',
            '4=Sering kali (lebih dari separuh waktu) dalam 4 minggu ini',
            '3=Kadang-kadang (sekitar separuh waktu) dalam 4 minggu ini',
            '2=Beberapa kali (kurang dari separuhnya) dalam 4 minggu ini',
            '1=Hampir tidak pemah atau tidak pemah dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, ketika Anda mendapat rangsangan seksual atau sedang berhubungan intim, seberapa sulitnya Anda untuk mencapai orgasme (klimaks)?',
        [
            '0=Tidak ada aktivitas seksual',
            '1=Sangat sulit atau tidak mungkin dalam 4 minggu ini',
            '2=Sangat sulit dalam 4 minggu ini',
            '3=Sulit dalam 4 minggu ini',
            '4=Sedikit sulit dalam 4 minggu ini',
            '5=Tidak sulit dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa puaskah Anda dengan kemampuan Anda untuk mencapai orgasme (klimaks) selama aktivitas seksual atau hubungan intim?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Sangat puas dalam 4 minggu ini',
            '4=Cukup puas dalam 4 minggu ini',
            '3=Kadang-kadang puas kadang-kadang tidak puas dalam 4 minggu ini',
            '2=Cukup puas dalam 4 minggu ini',
            '1=Sangat tidak puas dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa puas Anda dengan kedekatan emosional yang dialami selama aktivitas seksual atau hubungan intim antara Anda dan Suami Anda?',
        [
            '0=Tidak ada aktivitas seksual',
            '5=Sangat puas dalam 4 minggu ini',
            '4=Cukup puas dalam 4 minggu ini',
            '3=Kadang-kadang puas kadang-kadang tidak puas dalam 4 minggu ini',
            '2=Cukup puas dalam 4 minggu ini',
            '1=Sangat tidak puas dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhr, seberapa puas Anda dengan hubungan seksual Anda dengan Suami Anda?',
        [
            '5=Sangat puas dalam 4 minggu ini',
            '4=Cukup puas dalam 4 minggu ini',
            '3=Kadang-kadang puas kadang-kadang tidak puas dalam 4 minggu ini',
            '2=Cukup puas dalam 4 minggu ini',
            '1=Sangat tidak puas dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhr, seberapa puas Anda dengan kehidupan seksual Anda secara keseluruhan?',
        [
            '5=Sangat puas dalam 4 minggu ini',
            '4=Cukup puas dalam 4 minggu ini',
            '3=Kadang-kadang puas kadang-kadang tidak puas dalam 4 minggu ini',
            '2=Cukup puas dalam 4 minggu ini',
            '1=Sangat tidak puas dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, seberapa sering Anda mengalami ketidaknyamanan atau nyeri saat kemaluan suami anda masuk ke kemaluan anda?',
        [
            '0=Tidak mencoba hubungan seksual',
            '1=Hampir selalu atau selalu dalam 4 minggu ini',
            '2=Sering kali (lebih dari separuh waktu) dalam 4 minggu ini',
            '3=Kadang-kadang (sekitar separuh waktu) dalam 4 minggu ini',
            '4=Beberapa kali (kurang dari separuhnya) dalam 4 minggu ini',
            '5=Hampir tidak pernah atau tidak pernah dalam 4 minggu ini',
        ]
    ];
    $a[] = ['Selama 4 minggu teraklir, seberapa sering Anda mengalami ketidaknyamanan atau nyeri setelah penetrasi vagina?',
        [
            '0=Tidak mencoba hubungan seksual',
            '1=Hampir selalu atau selalu',
            '2=Sering kali (lebih dari separuh waktu)',
            '3=Kadang-kadang (sekitar separuh waktu)',
            '4=Beberapa kali (kurang dari separuhnya)',
            '5=Hampir tidak pemah atau tidak pernah',
        ]
    ];
    $a[] = ['Selama 4 minggu terakhir, bagaimana Anda menilai tingkat (derajat) dad ketidaknyamanan atau rasa sakit selama atau setelah penetrasi vagina?',
        [
            '0=Tidak mencoba hubungan seksual',
            '1=Sangat tinggi dalam 4 minggu ini',
            '2=Tinggi dalam 4 minggu ini',
            '3=Sedang dalam 4 minggu ini',
            '4=Rendah dalam 4 minggu ini',
            '5=Sangat rendah atau tidak ada sama sekali dalam 4 minggu ini',
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
