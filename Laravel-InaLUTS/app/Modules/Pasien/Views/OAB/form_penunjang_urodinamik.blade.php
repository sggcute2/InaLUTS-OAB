@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}

  @php
    echo '<form method="post" action="'.$form_action.'" onsubmit="javascript:return Form_123_checkValidation()">'.PHP_EOL;
    echo '<input type="hidden" name="_token" value="'.csrf_token().'">'.PHP_EOL;

    ob_start();
  @endphp

  <button type="button" class="btn bg-info" onclick="javascript:add_new_tab()">
    Add new tab
  </button>
  <br><br>

  <div class="nav-tabs-custom">
  @php
    echo '<ul class="nav nav-tabs">'.PHP_EOL;
    $no = 0;
    $show_tab = 0;
    foreach($default_by_id as $id => $def){
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
    foreach($default_by_id as $id => $def){
        //ob_start();

        $buffer = [];
        $no++;
        echo '<div class="tab-pane'.(($active_tab == $id) ? ' active' : '').'" id="tab_'.$id.'">'.PHP_EOL;

        FORM::setup([
            'formless' => true
            //'action' => $form_action
        ]);
        FORM::set_var($def);

        $buffer[] = '<b>Tanggal</b>'
            .'<br>'
            .BS::datepicker([
                'name' => 'tgl_'.$id.'_date',
                'required' => false,
            ], false);

        //====================[ Begin Follow Up : Form OAB_penunjang_urodinamik ]===
        $ns = '';
        //Neurogenic Bladder
        $temp = '
            Kapasitas kandung kemih
            <i>Compliance</i>
            <i>Detrusor Overactivity</i>
            <i>Detrusor Overactivity Incontinence</i>
            <i>Urodynamic Stress Urinary Incontinence</i>
            Obstruksi infravesical
            <i>Detrusor Underactivity</i>
            <i>Dysfunctional Voiding</i>
            <i>Detrusor Sphincter Dyssynergia</i>
            PVR
        ';
        $x = explode("\n", $temp);

        /*
        $buffer[] = '<b>Tanggal</b>'
            .'<br>'
            .BS::datepicker([
                'name' => $ns.'pemeriksaan_urodinamik_ya_date',
                'required' => false,
            ], false);
        */

        foreach($x as $v){
            if (trim($v) != '') {
                $caption = trim($v);
                $field = strtolower(str_replace(array(' ', '-'), '_', str_replace(array('<i>','</i>'),'',$caption)));
                $field .= '_'.$id;
                switch($field) {
                    case 'kapasitas_kandung_kemih_'.$id:
                    case 'pvr_'.$id:
                        $buffer[] = '<b>'.$caption.'</b>'
                            .'<br>'
                            .BS::number([
                                'name' => $ns.$field.'_1',
                                'inline' => true
                            ], false)
                            .' - '
                            .BS::number([
                                'name' => $ns.$field.'_2',
                                'inline' => true
                            ], false)
                            .' ml';
                        break;

                    case 'compliance_'.$id:
                        $buffer[] = '<b>'.$caption.'</b>'
                            .'<br>'
                            .BS::radio_array([
                                    'name' => $ns.$field,
                                    'data' => ['Normal', 'Tidak Normal'],
                                ], false);
                        break;

                    case 'dysfunctional_voiding_'.$id:
                        $buffer[] = '<b>'.$caption.'</b>'
                            .'<br>'
                            .BS::radio_array([
                                    'name' => $ns.$field,
                                    'data' => ['Ya', 'Tidak'/*, 'Tidak Diperiksa'*/],
                                ], false);
                        break;

                    default :
                        $buffer[] = '<b>'.$caption.'</b>'
                            .'<br>'
                            .BS::radio_ya_tidak([
                                'name' => $ns.$field,
                            ], false);
                        break;
                }
            }
        }

        $table_files = '';
        $table_files .= '<div style="margin-top:8px" id="result_file_'.$id.'">';
        if (isset($def['tgl_'.$id.'_date'])) {
            if (defined('PAGE_IS_FOLLOW_UP') && PAGE_IS_FOLLOW_UP) {
                $table_files .= BS::dropzone_list_file(
                    App\Modules\Dropzone\Models\OAB_media_follow_up_v2::class,
                    [
                        'table_reference' => 'follow_up_v2_oab_penunjang_urodinamik',
                        'reference_id' => $pasien_id,
                        'custom_field_1' => $no,
                    ]
                );
            } else {
                $table_files .= BS::dropzone_list_file(
                    App\Modules\Dropzone\Models\OAB_media::class,
                    [
                        'table_reference' => 'oab_penunjang_urodinamik',
                        'reference_id' => $pasien_id,
                        'custom_field_1' => $no,
                    ]
                );
            }
        } else {
            $table_files .= BS::info('<i>Simpan data pada Tab '.$no.' ini dengan mengisi Tanggal terlebih dahulu.</i>', false);
        }
        $table_files .= '</div>';
        if (isset($def['tgl_'.$id.'_date'])) {
            $file_upload = BS::dropzone([
                    'name' => 'file_'.$id,
                    'params' => [
                        'name' => 'file_'.$id,
                        'table_reference' =>
                            (defined('PAGE_IS_FOLLOW_UP') && PAGE_IS_FOLLOW_UP)
                            ? 'follow_up_v2_oab_penunjang_urodinamik'
                            : 'oab_penunjang_urodinamik',
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
        $buffer[] = '<b>Files</b>'
            .'<br>'
            .$table_files.$file_upload;
        //======================[ End Follow Up : Form OAB_penunjang_urodinamik ]===

        echo implode('<br><br>', $buffer);

        //echo '<div style="border:solid 1px red">';
        //echo '<div>'.$id;
        echo '<div>';
        echo '<input type="hidden" name="hid_id[]" value="'.$id.'">'.PHP_EOL;
        echo '</div>';

        echo '</div><!-- ./tab-pane -->'.PHP_EOL;

        //$html = ob_get_contents();
        //ob_end_clean();

        //$html = str_replace('<form ', '<xno-form ', $html);
        //$html = str_replace('function Form_', 'function xno_Form_', $html);
        //$html = str_replace('</form>', '</xno-form>', $html);

        //echo $html;
    } // end : foreach($default_by_id as $id => $def)

    echo '</div><!-- ./tab-content -->'.PHP_EOL;

    $all_html = ob_get_contents();
    ob_end_clean();

    FORM::set_var($default);

    FORM::row(
        'Pemeriksaan urodinamik',
        BS::radio_ya_tidak([
            'name' => 'pemeriksaan_urodinamik',
            'toggle_div' => true,
        ], false)
    );
    FORM::row(':merge',
        '<div id="div_pemeriksaan_urodinamik_ya" class="indent1">'
        .$all_html
        .'</div>'
    );
    if (
        isset($default['pemeriksaan_urodinamik'])
        && $default['pemeriksaan_urodinamik'] == 'Ya'
    ) {
    } else {
        BS::jquery_ready("$('#div_pemeriksaan_urodinamik_ya').hide();");
    }

    FORM::show();
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
