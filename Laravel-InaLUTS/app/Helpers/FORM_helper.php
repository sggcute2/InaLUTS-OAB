<?php
class FORM {

static $config;
static $multipart;
static $hidden;
static $set_var;
static $z1_L;
static $z1_R;
static $z2_L;
static $z2_R;
static $z3_L;
static $z3_R;
static $z4_L;
static $z4_R;
static $z5_L;
static $z5_R;
static $z1_sub;
static $z2_sub;
static $z3_sub;
static $z4_sub;
static $z5_sub;
static $rules;
static $preview;
static $has_required;

# Setup
static function setup($p = array()) {
  self::reset();

  self::$config = $p;
  if (!isset(self::$config['submit'])) {
    self::$config['submit'] = (EDIT || ADD) ? 'Save' : 'Submit';
  }
  if (!isset(self::$config['reset'])) {
    self::$config['reset'] = (ADD) ? 'Reset' : 'Reset';
  }
  if (!isset(self::$config['cancel'])) {
    self::$config['cancel'] = 'Cancel';
  }
  self::$preview = false;
  self::$has_required = false;
}

# Set Variables
static function set_var($p) {
  if (is_object($p)) {
    $p = json_decode(json_encode($p), true);
  }
  foreach($p as $i => $v) self::$set_var[$i] = $v;
}

# Get Variables
static function get_var($n = '') {
  return self::$set_var[$n] ?? null;
}

# Set Preview
static function set_preview($p = true) {
  self::$preview = $p;
}

# Is Preview
static function is_preview() {
  return self::$preview;
}

# Set has_required
static function set_has_required($p = true) {
  self::$has_required = $p;
}

# Has Required
static function has_required($p = true) {
  return self::$has_required;
}

# Reset
static function reset() {
  self::$multipart = false;
  self::$hidden = array();
  self::$set_var = array();
  self::$z1_L = array();
  self::$z1_R = array();
  self::$z2_L = array();
  self::$z2_R = array();
  self::$rules = array();
}

# Title
static function title($id = 0, $t = '', $args = []) {
  return ($id ? 'Edit' : 'Tambah') . ' ' . $t;
}

# Form Table Row
static function row($c = '', $v = '', $args = array()) {
  self::$z1_L[] = $c;
  self::$z1_R[] = $v;
  self::$z1_sub[] = (isset($args['sub'])) ? $args['sub'] : '';
}

# Form Table Row2
static function row2($c = '', $v = '', $args = array()) {
  self::$z2_L[] = $c;
  self::$z2_R[] = $v;
  self::$z2_sub[] = (isset($args['sub'])) ? $args['sub'] : '';
}

# Form Table Row3
static function row3($c = '', $v = '') {
  self::$z3_L[] = $c;
  self::$z3_R[] = $v;
  self::$z3_sub[] = (isset($args['sub'])) ? $args['sub'] : '';
}

# Form Table Row4
static function row4($c = '', $v = '') {
  self::$z4_L[] = $c;
  self::$z4_R[] = $v;
  self::$z4_sub[] = (isset($args['sub'])) ? $args['sub'] : '';
}

# Form Table Row5
static function row5($c = '', $v = '') {
  self::$z5_L[] = $c;
  self::$z5_R[] = $v;
  self::$z5_sub[] = (isset($args['sub'])) ? $args['sub'] : '';
}

# Form Table Row Raw
static function row_string($c = '', $v = '') {
  return self::_row_show(array($c), array($v));
}

# Hidden
static function hidden($n = '', $v = '') {
  self::$hidden[] = array('id'    => trim($n),
                          'value' => trim($v)
                         );
}

# Set Alert
static function alert($n = '', $a = '', $type = false) {
  self::$rules[] = array('id'    => $n,
                         'alert' => $a,
                         'type'  => $type
                        );
}

# Process Row
static private function _row_show($L = array(), $R = array(), $L_sub = array()) {
  $z = '';
  foreach ($L as $index => $value) {
    $caption = (trim($value)=='') ? "&nbsp;" : "$value";
    if ($value == ':merge') {
      $z .= '<div class="form-group">'.PHP_EOL;
      $z .= $R[$index].PHP_EOL;
      $z .= '</div>'.PHP_EOL;
    } else if ($value == ':header') {
      $z .= '<div ';
      $z .= 'class="form-group" ';
      $z .= 'style="text-align:center;background:darkblue;padding:5px;';
      $z .= 'font-weight:bold;color:white">'.PHP_EOL;
      $z .= $R[$index].PHP_EOL;
      $z .= '</div>'.PHP_EOL;
    } else if ($value == ':header2') {
      $z .= '<div ';
      $z .= 'class="form-group" ';
      $z .= 'style="text-align:center;background:#00a65a;padding:5px;';
      $z .= 'font-weight:bold;color:white">'.PHP_EOL;
      $z .= $R[$index].PHP_EOL;
      $z .= '</div>'.PHP_EOL;
    } else if ($value == ':title') {
      $z .= '<div class="form-group" style="color:green;font-weight:bold">'.PHP_EOL;
      $z .= $R[$index].PHP_EOL;
      $z .= '</div>'.PHP_EOL;
    } else if ($value == ':div') {
      $z .= '<div '.$R[$index].'>'.PHP_EOL;
    } else if ($value == ':/div') {
      $z .= '</div>'.PHP_EOL;
    } else {
      $z .= '<div class="form-group">'.PHP_EOL;
      $z .= '<label>'.$caption.'</label><br />'.PHP_EOL;
      if (isset($L_sub[$index]) && $L_sub[$index]) $z .= $L_sub[$index].'<br />'.PHP_EOL;
      $z .= $R[$index].PHP_EOL;
      $z .= '</div>'.PHP_EOL;
    }
  }

  return $z;
}

# Output by Showing Form
static function show($echo = true) {
  $NS = 'Form_'.str_shuffle('123456789').'_';
  $formless  = (isset(self::$config['formless']) && self::$config['formless']);
  $multipart = (
    isset(self::$config['multipart'])
    && self::$config['multipart']
  ) ? ' enctype="multipart/form-data"' : '';
  $extra = (isset(self::$config['extra'])) ? ' '.self::$config['extra'] : '';
  $id = (isset(self::$config['id'])) ? ' id="'.self::$config['id'].'"' : '';
  $on_submit = ' onsubmit="javascript:return '.$NS.'checkValidation()"';
  $str = '';

  if ($formless) {
    $str .= '<div class="FW___FORM" id="div_'.$NS.'">'.PHP_EOL;
  } else {
    $str .= '<form ';
    $str .= 'class="FW___FORM" ';
    $str .= 'role="form" ';
    $str .= 'method="post" ';
    $str .= 'action="'.(self::$config['action'] ?? '').'" ';
    $str .= $id;
    $str .= $multipart;
    $str .= $extra;
    $str .= $on_submit;
    $str .= '>'.PHP_EOL;
    $str .= '<input type="hidden" name="_token" value="'.csrf_token().'">'.PHP_EOL;
  }
  // Begin : Row 1 & 2
  $z1 = (self::$z1_L) ? self::_row_show(self::$z1_L, self::$z1_R, self::$z1_sub) : '';
  $z2 = (self::$z2_L) ? self::_row_show(self::$z2_L, self::$z2_R, self::$z2_sub) : '';
  $has_row2 = (trim($z2) != '');
  $str .= '<div class="box-body" data-line="'.__LINE__.'">'.PHP_EOL;
  $str .= '<div class="row" style="padding:0 10px">'.PHP_EOL;
  if ($has_row2) {
    $str .= '<div class="col-md-6">'.$z1.'</div><!-- /.col-md-6 -->'.PHP_EOL;
    $str .= '<div class="col-md-6">'.$z2.'</div><!-- /.col-md-6 -->'.PHP_EOL;
  } else {
    $str .= $z1;
  }
  $str .= '</div><!-- /.row -->'.PHP_EOL;
  $str .= '</div><!-- /.box-body -->'.PHP_EOL;
  // End : Row 1 & 2
  // Begin : Row 3
  if (self::$z3_L) {
    $z3 = self::_row_show(self::$z3_L, self::$z3_R, self::$z3_sub);
    $str .= '<div class="box-body" data-line="'.__LINE__.'">'.PHP_EOL;
    $str .= '<div class="row" style="padding:0 10px">'.PHP_EOL;
    $str .= $z3;
    $str .= '</div><!-- /.row -->'.PHP_EOL;
    $str .= '</div><!-- /.box-body -->'.PHP_EOL;
  }
  // End : Row 3
  // Begin : Row 4 & 5
  $z4 = (self::$z4_L) ? self::_row_show(self::$z4_L, self::$z4_R, self::$z4_sub) : '';
  $z5 = (self::$z5_L) ? self::_row_show(self::$z5_L, self::$z5_R, self::$z5_sub) : '';
  $has_row2 = (trim($z5) != '');
  if ($has_row2) {
    $str .= '<div class="box-body" data-line="'.__LINE__.'">'.PHP_EOL;
    $str .= '<div class="row" style="padding:0 10px">'.PHP_EOL;

    $str .= '<div class="col-md-6">'.$z4.'</div><!-- /.col-md-6 -->'.PHP_EOL;
    $str .= '<div class="col-md-6">'.$z5.'</div><!-- /.col-md-6 -->'.PHP_EOL;

    $str .= '</div><!-- /.row -->'.PHP_EOL;
    $str .= '</div><!-- /.box-body -->'.PHP_EOL;
  } else {
    if (trim($z4) != '') {
      $str .= '<div class="box-body" data-line="'.__LINE__.'">'.PHP_EOL;
      $str .= '<div class="row" style="padding:0 10px">'.PHP_EOL;

      $str .= $z4;

      $str .= '</div><!-- /.row -->'.PHP_EOL;
      $str .= '</div><!-- /.box-body -->'.PHP_EOL;
    }
  }
  // End : Row 4 & 5
  if (self::$hidden) {
    foreach (self::$hidden as $v) {
      $str .= '<input ';
      $str .= 'type="hidden" ';
      $str .= 'id="'.$v['id'].'" ';
      $str .= 'name="'.$v['id'].'" ';
      $str .= 'value="'.$v['value'].'" ';
      $str .= '/>'.PHP_EOL;
    }
  }
  if ($formless) {
    $str .= '</div>'.PHP_EOL;
  } else {
    $str .= '<div class="box-footer">'.PHP_EOL;
    if (self::has_required()) {
      $str .= '<div style="margin:8px 0">'.PHP_EOL;
      $str .= '  <label class="required"></label> = Required field'.PHP_EOL;
      $str .= '</div>'.PHP_EOL;
    }
    $str .= '  <div id="'.$NS.'waiting" '.PHP_EOL;
    $str .= '    style="margin:5px 0;font-size:150%;display:none">'.PHP_EOL;
    $str .= '    <i class="fa fa-spinner fa-spin"></i> Please wait while processing ...'.PHP_EOL;
    $str .= '  </div>'.PHP_EOL;
    $str .= '  <div id="'.$NS.'the_buttons">'.PHP_EOL;
    $str .= '    <button type="submit" class="btn btn-primary">'.PHP_EOL;
    $str .= '      '.self::$config['submit'].PHP_EOL;
    $str .= '    </button>'.PHP_EOL;
    if(!isset(self::$config['disable_reset']) || !self::$config['disable_reset']){
      $str .= '    <button type="button" class="btn bg-navy" onclick="javascript:location.reload(true)">'.PHP_EOL;
      $str .= '      '.self::$config['reset'].PHP_EOL;
      $str .= '    </button>'.PHP_EOL;
    }
    if(!isset(self::$config['disable_cancel']) || !self::$config['disable_cancel']){
      $str .= '    <button type="button" class="btn" '.PHP_EOL;
      $str .= '      onclick="javascript:history.back(1)">'.PHP_EOL;
      $str .= '      Cancel'.PHP_EOL;
      $str .= '    </button>'.PHP_EOL;
    }
    if (defined('IS_DETAIL_PATIENT') && IS_DETAIL_PATIENT) {
      $str .= str_repeat('&nbsp;', 10);
      $str .= '    <button type="button" class="btn" '.PHP_EOL;
      $str .= '      onclick="javascript:if(confirm(\'Are you sure to clear the value for this form?\'))location.href=\''.URL::to(MODULE.'/clear_'.ACTION.'/'.ID).'\'">'.PHP_EOL;
      $str .= '      Clear'.PHP_EOL;
      $str .= '    </button>'.PHP_EOL;
    }
    $str .= '  </div>'.PHP_EOL;
    $str .= '</div>'.PHP_EOL;

    $all_rules = '';
    foreach (self::$rules as $v) {
      if ($v['type'] == 'function') {
        $all_rules .= 'return '.$v['alert'].'();'.PHP_EOL;
      } else if ($v['type'] == 'echo') {
        $all_rules .= $v['alert'].PHP_EOL;
      } else if ($v['type'] == 'selected') {
        $all_rules .= "if(jQuery('#{$v['id']}').val() * 1 < 1){".PHP_EOL;
        $all_rules .= "alert('{$v['alert']}');".PHP_EOL;
        $all_rules .= "jQuery('#{$v['id']}').focus();".PHP_EOL;
        $all_rules .= "return false;".PHP_EOL;
        $all_rules .= "}".PHP_EOL;
      } else {
        $all_rules .= "if(jQuery.trim(jQuery('#{$v['id']}').val())==''){".PHP_EOL;
        $all_rules .= "alert('{$v['alert']}');".PHP_EOL;
        $all_rules .= "jQuery('#{$v['id']}').val('');".PHP_EOL;
        $all_rules .= "jQuery('#{$v['id']}').focus();".PHP_EOL;
        $all_rules .= "jQuery('html,body').scrollTop(".PHP_EOL;
        $all_rules .= "jQuery('#{$v['id']}').offset().top-80".PHP_EOL;
        $all_rules .= ");".PHP_EOL;
        $all_rules .= "return false;".PHP_EOL;
        $all_rules .= "}".PHP_EOL;
      }
    }

    $after_checkValidation = '';
    if (isset(self::$config['after_checkValidation'])) {
      $after_checkValidation .= PHP_EOL
        .'/* Begin : after_checkValidation */'.PHP_EOL
        .self::$config['after_checkValidation']
        .PHP_EOL
        .'/* End : after_checkValidation */'.PHP_EOL;
    }

    $str .= "
      <script language=\"javascript\">
      function {$NS}checkValidation(){
        $all_rules
        const NS = '{$NS}';
        jQuery('#{$NS}the_buttons').hide();
        jQuery('#{$NS}waiting').show();{$after_checkValidation}
      }
      </script>
    ";

    $str .= '</form>'.PHP_EOL;
  }

  if ($echo) {
    echo $str;
  } else {
    return $str;
  }
}
  
}
