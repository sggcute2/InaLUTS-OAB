@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}

    <button type="button" class="btn bg-info" onclick="javascript:add_new_tab()">
      Add new tab
    </button>
    <br><br>

  @php
    echo '<form method="post" action="'.$form_action.'" onsubmit="javascript:return Form_123_checkValidation()">'.PHP_EOL;
    echo '<input type="hidden" name="_token" value="'.csrf_token().'">'.PHP_EOL;
  @endphp

  <div class="nav-tabs-custom">
  @php
    echo '<ul class="nav nav-tabs">'.PHP_EOL;
    $no = 0;
    $show_tab = 0;
    foreach($default_by_id as $id => $default){
        $no++;
        if ($id < 1000 * 1000) $show_tab++;
        $style = ($id > 1000 * 1000) ? 'display:none;' : '';
        echo '<li id="tab_ke_'.$no.'" class="'.(($active_tab == $id) ? 'active' : '').'" style="'.$style.'">'.PHP_EOL;
        echo '    <a href="#tab_'.$id.'" data-toggle="tab" aria-expanded="true">'.$no.'</a>'.PHP_EOL;
        echo '</li>'.PHP_EOL;
    }
    echo '</div><!-- ./nav-tabs -->'.PHP_EOL;
    echo '<div class="tab-content">'.PHP_EOL;
    $no = 0;
    foreach($default_by_id as $id => $default){
        $no++;
        echo '<div class="tab-pane'.(($active_tab == $id) ? ' active' : '').'" id="tab_'.$id.'">'.PHP_EOL;

        ob_start();

        FORM::setup([
            'formless' => true
            //'action' => $form_action
        ]);
        FORM::set_var($default);

        FORM::row('Tanggal',
            BS::datepicker([
                'name' => 'tgl_'.$id.'_date',
                'required' => false,
            ], false)
        );

        //==================[ Begin Follow Up : Form OAB_penunjang_uroflowmetri ]===
        $ns = '';
        $temp = '
            Voided volume;ml
            Q max;ml / detik
            Q ave;ml
            PVR;ml
            <i>Voiding time</i>;detik
        ';
        $x = explode("\n", $temp);
        foreach($x as $v){
            if (trim($v) != '') {
                $caption = trim($v);
                $x2 = explode(';', $caption);
                $caption = $x2[0];
                $field = strtolower(str_replace(array(' ', '-'), '_', str_replace(array('<i>','</i>'), '', $x2[0])));
                $field .= '_'.$id;
                $uom = $x2[1];

                FORM::row(
                    $caption,
                    BS::radio_ya_tidak([
                        'name' => $ns.$field,
                        'toggle_div' => true,
                    ], false)
                );

                $step = '';
                if (
                    $field == 'voided_volume'
                    || $field == 'q_max'
                    || $field == 'q_ave'
                    || $field == 'pvr'
                ) {
                    $step = '0.01';
                }
                $temp_number = BS::number([
                    'name' => $ns.$field.'_ya',
                    'inline' => true,
                    'step' => $step,
                ], false);

                FORM::row(':merge',
                    '<div id="div_'.$ns.$field.'_ya" class="indent1">'
                    /*
                    .'Tanggal : '
                    .BS::datepicker([
                        'name' => $ns.$field.'_ya_date',
                        'required' => false,
                    ], false)
                    .'<br>'
                    */
                    .$temp_number
                    .' '.$uom
                    .'</div>'
                );
                if (isset($default[$ns.$field]) && $default[$ns.$field] == 'Ya') {
                } else {
                    BS::jquery_ready("$('#div_{$ns}{$field}_ya').hide();");
                }
            }
        }

        $temp = '';
        $a = [];
        $a[] = ['A', 'Bell shaped'];
        $a[] = ['B', 'Tower shaped'];
        $a[] = ['C', 'Plateau shaped'];
        $a[] = ['D', 'Staccato shaped'];
        $a[] = ['E', 'Interrupted shaped'];
        $i2 = 0;
        foreach($a as $v){
            $i2++;
            $temp .= '<div style="margin-bottom:1em">';
            $temp .= '<input type="radio" class="iCheck" id="bentuk_kurva_uroflowmetri_'.$id.'_'.$i2.'" name="bentuk_kurva_uroflowmetri_'.$id.'" value="'.$v[0].'"';
            if (isset($default['bentuk_kurva_uroflowmetri_'.$id]) && $default['bentuk_kurva_uroflowmetri_'.$id] == $v[0]) $temp .= ' checked="checked"';
            $temp .= '>';
            $temp .= ' '.$v[1];
            $temp .= '<div style="margin-bottom:1em">';
            $temp .= '<img src="'.asset('img/Kurva_Uroflowmetri_'.$v[0].'.png').'">';
            $temp .= '</div>';
            $temp .= '</div>';
        }
        FORM::row(
            'Bentuk Kurva Uroflowmetri',
            $temp
        );

        $table_files = '';
        $table_files .= '<div style="margin-top:8px" id="result_file_'.$id.'">';
        if (isset($default['tgl_'.$id.'_date'])) {
            if (defined('PAGE_IS_FOLLOW_UP') && PAGE_IS_FOLLOW_UP) {
                $table_files .= BS::dropzone_list_file(
                    App\Modules\Dropzone\Models\OAB_media_follow_up_v2::class,
                    [
                        'table_reference' => 'follow_up_v2_oab_penunjang_uroflowmetri',
                        'reference_id' => $pasien_id,
                        'custom_field_1' => $no,
                    ]
                );
            } else {
                $table_files .= BS::dropzone_list_file(
                    App\Modules\Dropzone\Models\OAB_media::class,
                    [
                        'table_reference' => 'oab_penunjang_uroflowmetri',
                        'reference_id' => $pasien_id,
                        'custom_field_1' => $no,
                    ]
                );
            }
        } else {
            $table_files .= BS::info('<i>Simpan data pada Tab '.$no.' ini dengan mengisi Tanggal terlebih dahulu.</i>', false);
        }
        $table_files .= '</div>';
        if (isset($default['tgl_'.$id.'_date'])) {
            $file_upload = BS::dropzone([
                    'name' => 'file_'.$id,
                    'params' => [
                        'name' => 'file_'.$id,
                        'table_reference' =>
                            (defined('PAGE_IS_FOLLOW_UP') && PAGE_IS_FOLLOW_UP)
                            ? 'follow_up_v2_oab_penunjang_uroflowmetri'
                            : 'oab_penunjang_uroflowmetri',
                        'reference_id' => $pasien_id,
                        'custom_field_1' => $no,
                    ],
                    'init_onSuccess' => "
                        function(file, response) {
                            enable_debug = true;
                            if (enable_debug) console.log(response);
    
                            $('#result_file_{$id}').html(
                              '<a '
                              +'  href=\"javascript:void(0)\" '
                              +'  class=\"btn icon icon-left btn-success\"'
                              +'>'
                              +'  <i class=\"fa fa-check-circle\"></i>'
                              +'  Success'
                              +'</a>'
                              +'<br><br>'
                            );
                            setTimeout(function(){
                              $('#result_file_{$id}').html(response.html);
                            }, 2 * 1000);
                        }
                    ",
                ], false);
            } else {
                $file_upload = '';
            }
        FORM::row('Files', $table_files.$file_upload);

        FORM::show();

        $html = ob_get_contents();
        //$html = str_replace('<form ', '<xno-form ', $html);
        //$html = str_replace('function Form_', 'function xno_Form_', $html);
        //$html = str_replace('</form>', '</xno-form>', $html);
        ob_end_clean();

        //echo '<div style="border:solid 1px red">';
        //echo '<div>'.$id;
        echo '<div>';
        echo '<input type="hidden" name="hid_id[]" value="'.$id.'">'.PHP_EOL;
        echo $html;
        echo '</div>';

        echo '</div><!-- ./tab-pane -->'.PHP_EOL;
    } // end : foreach($default_by_id as $id => $default)
    echo '</div><!-- ./tab-content -->'.PHP_EOL;
    //====================[ End Follow Up : Form OAB_penunjang_uroflowmetri ]===
  @endphp

  <hr>
  <div id="Form_123_waiting" style="margin:5px 0;font-size:150%;display:none">
    <i class="fa fa-spinner fa-spin"></i> Please wait while processing ...
  </div>
  <div id="Form_123_the_buttons">
    <button type="submit" class="btn btn-primary">
      Submit
    </button>
    <button type="button" class="btn bg-navy" onclick="javascript:location.reload(true)">
      Reset
    </button>
    <button type="button" class="btn" onclick="javascript:history.back(1)">
      Cancel
    </button>
  </div>
    <script language="javascript">
      function Form_123_checkValidation(){
        const NS = 'Form_123_';
        jQuery('#Form_123_the_buttons').hide();
        jQuery('#Form_123_waiting').show();
      }
    </script>

  @php
    echo '</form>'.PHP_EOL;
  @endphp
  </div><!-- ./nav-tabs-custom -->
  {{ BS::box_end() }}

    <script language="javascript">
      let n_tab = {{ $show_tab }};
      function add_new_tab(){
        if (n_tab < 5) {
            n_tab++;
            jQuery('#tab_ke_'+n_tab).show();
        } else {
            // Reach the limit of number of tab
            alert('Maximum is 5 tabs');
        }
      }
    </script>

@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
@endsection
