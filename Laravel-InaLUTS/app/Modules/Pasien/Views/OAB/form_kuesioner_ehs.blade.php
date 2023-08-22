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

    FORM::row('Selama melakukan aktivitas seksual, kondisi penis mana yang cocok dengan anda?',
        BS::radio_array([
            'name' => 'score_1',
            'data' => [
                ['value' => 1, 'text' => 'Penis membesar namun tidak keras. Tingkat kekerasannya hanya seperti tahu atau tape'],
                ['value' => 2, 'text' => 'Penis membesar dan mengeras namun tidak cukup kuat untuk penetrasi. Tingkat kekerasannya hanya seperti buah pisang tanpa kulit'],
                ['value' => 3, 'text' => 'Penis membesar dan keras sehingga cukup kuat untuk penetrasi, tetapi tingkat kekerasannya hanya seperti pisang dengan kulit'],
                ['value' => 4, 'text' => 'Penis membesar, keras, dan tegang sepenuhnya seperti timun muda'],
            ],
            'vertical' => true,
        ], false)
    );

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
function score_onCheck(i){
    //const score = $('input[name="score_'+i+'"]:checked').val();
    //console.log(i+' = '+score);
    //$('#span_score_'+i).html(score);

    //let score_1 = parseInt($('input[name="score_1"]:checked').val());
    //if (isNaN(score_1)) score_1 = 0;
    //$('#span_total_score').html(total_score_1 + score_2 + score_3 + score_4);
}

@for($i=1;$i<=1;$i++)
$('input[name=\"score_{{ $i }}\"]').on('ifChecked', function(){
    score_onCheck( {{ $i }} );
});
@endfor

// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');

score_onCheck(1);
@endsection
