<?php
class BS {

private static $enable_show_name = false;
private static $jquery_ready = [];

# toArray
static function toArray($obj){
  return json_decode(json_encode($obj), true);
}

# Title
static function title($t = ''){
?>
<h3 style="margin-top:10px"><?= $t ?></h3>
<?php
}

# Title2
static function title2($t = ''){
?>
<h4><?= $t ?></h4>
<?php
}

# Info
static function info($m = '', $echo = true) {
  $s = '<div class="alert alert-success"><h4><i class="icon fa fa-check"></i>Info</h4>'.$m.'</div>';
  if ($echo) {
    echo $s;
  } else {
    return $s;
  }
}

# Error
static function error($m = '') {
?>
<div class="alert alert-danger"><h4><i class="icon fa fa-exclamation-circle"></i>Error</h4><?= $m ?></div>
<?php
}

# Warning
static function warning($m = '') {
?>
<div class="alert alert-warning"><h4><i class="icon fa fa-warning"></i>Warning</h4><?= $m ?></div>
<?php
}

# Box Begin
static function box_begin($t = '') {
?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?= $t ?></h3>
  </div>
  <div class="box-body">
<?php
}

# Box End
static function box_end() {
?>
  </div><!-- /.box-body -->
</div><!-- /.box -->
<?php
}

# Button
static function button($t = '', $url = '', $echo = true){
  if($url != '')$url = ' onclick="javascript:location.href=\''.$url.'\'"';
  $btn = '<button type="button" class="btn btn-primary"'.$url.'>'.$t.'</button>';
  if ($echo) {
    echo $btn;
  } else {
    return $btn;
  }
}

# Button Delete
static function button_delete($t = '', $url = '', $echo = true){
  if($url != '')$url = ' onclick="javascript:if(confirm(\'Are you sure to delete?\'))location.href=\''.$url.'\'"';
  $btn = '<button type="button" class="btn btn-danger"'.$url.'>'.$t.'</button>';
  if ($echo) {
    echo $btn;
  } else {
    return $btn;
  }
}

# Textbox
static function textbox($p = array(), $echo = true){
  $name = $p['name'] ?? '';
  $preview = FORM::is_preview();
  $default_value = FORM::get_var($name);
  //dd($default_value);
  $out = $default_value;
  $out = htmlspecialchars($out, ENT_QUOTES);

  if ($preview) {
    if ($echo) {
      echo $out;
      return;
    } else {
      return $out;
    }
  }

  $id = $p['id'] ?? $name;
  $is_inline = $p['inline'] ?? false;
  $placeholder = $p['placeholder'] ?? '';
  $size = $p['size'] ?? '';
  $a_class = (isset($p['class'])) ? ' '.$p['class'] : '';
  $readonly = $p['readonly'] ?? '';
  $required = $p['required'] ?? false;
  if ($required) FORM::set_has_required();
  $fake_required = (defined('FORCE_DISABLED_REQUIRED') && FORCE_DISABLED_REQUIRED);
  if ($required) {
    if ($fake_required) $required = false;
  } else {
    $fake_required = false;
  }
  $disabled = $p['disabled'] ?? '';

  $buffer = array();
  $buffer[] = 'type="text"';
  $buffer[] = 'class="input-text form-control'.(($is_inline)?'-inline':'').$a_class.'"';
  $buffer[] = 'name="'.$name.'"';
  $buffer[] = 'id="'.$id.'"';
  $buffer[] = 'placeholder="'.$placeholder.'"';
  if ($size) $buffer[] = 'size="'.$size.'"';
  if ($readonly) $buffer[] = 'readonly="readonly"';
  if ($required) $buffer[] = 'required="required"';
  if ($fake_required) $buffer[] = 'fake_required="fake_required"';
  if ($disabled) $buffer[] = 'disabled="disabled"';
  $buffer[] = 'value="'.strval($default_value).'"';

  $ret = '<input '.implode(' ', $buffer).' />';
  if (self::$enable_show_name) $ret .= '<span style="background:yellow">'.$name.'</span>';
  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Email
static function email($p = array(), $echo = true){
  $ret = self::textbox($p, false);
  $ret = str_replace('type="text"', 'type="email"', $ret);
  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Textarea
static function textarea($p = array(), $echo = true){
  $name = $p['name'] ?? '';
  $preview = FORM::is_preview();
  $default_value = FORM::get_var($name);
  //dd($default_value);
  $out = $default_value;
  $out = htmlspecialchars($out, ENT_QUOTES);

  if ($preview) {
    if ($echo) {
      echo $out;
      return;
    } else {
      return $out;
    }
  }

  $id = $p['id'] ?? $name;
  $is_inline = $p['inline'] ?? false;
  $placeholder = $p['placeholder'] ?? '';
  $rows = $p['rows'] ?? '3';
  $cols = $p['cols'] ?? '';
  $a_class = (isset($p['class'])) ? ' '.$p['class'] : '';
  $readonly = $p['readonly'] ?? '';
  $required = $p['required'] ?? false;
  if ($required) FORM::set_has_required();
  $fake_required = (defined('FORCE_DISABLED_REQUIRED') && FORCE_DISABLED_REQUIRED);
  if ($required) {
    if ($fake_required) $required = false;
  } else {
    $fake_required = false;
  }
  $disabled = $p['disabled'] ?? '';

  $buffer = array();
  $buffer[] = 'class="input-text form-control'.(($is_inline)?'-inline':'').$a_class.'"';
  $buffer[] = 'name="'.$name.'"';
  $buffer[] = 'id="'.$id.'"';
  $buffer[] = 'placeholder="'.$placeholder.'"';
  if ($rows) $buffer[] = 'rows="'.$rows.'"';
  if ($cols) $buffer[] = 'cols="'.$cols.'"';
  if ($readonly) $buffer[] = 'readonly="readonly"';
  if ($required) $buffer[] = 'required="required"';
  if ($fake_required) $buffer[] = 'fake_required="fake_required"';
  if ($disabled) $buffer[] = 'disabled="disabled"';

  $ret  = '<textarea '.implode(' ', $buffer).'>';
  $ret .= strval($default_value);
  $ret .= '</textarea>';
  if (self::$enable_show_name) $ret .= '<span style="background:yellow">'.$name.'</span>';
  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Select2
static function select2($p = array(), $echo = true){
  $name = $p['name'] ?? '';
  $preview = FORM::is_preview();
  $default_value = FORM::get_var($name);
  //dd($default_value);
  $data = self::toArray($p['data'] ?? array());
  $out = $data[$default_value] ?? '';

  if ($preview) {
    if ($echo) {
      echo $out;
      return;
    } else {
      return $out;
    }
  }

  $id = $p['id'] ?? $name;
  $with_blank = $p['with_blank'] ?? false;
  $field_value = $p['field_value'] ?? 'id';
  $field_text = $p['field_text'] ?? 'name';
  $required = $p['required'] ?? false;
  if ($required) FORM::set_has_required();
  $fake_required = (defined('FORCE_DISABLED_REQUIRED') && FORCE_DISABLED_REQUIRED);
  if ($required) {
    if ($fake_required) $required = false;
  } else {
    $fake_required = false;
  }

  $buffer = array();
  $buffer[] = 'id="'.$id.'"';
  $buffer[] = 'name="'.$name.'"';
  if ($required) $buffer[] = 'required="required"';
  if ($fake_required) $buffer[] = 'fake_required="fake_required"';
  $ret  = '<select class="form-control select2" '.implode(' ', $buffer).'>'.PHP_EOL;
  if ($with_blank) $ret .= '<option value="">&nbsp;</option>'.PHP_EOL;
  foreach ($data as $v) {
    if (gettype($v) == 'string') {
      $v = array(
        $field_value => $v,
        $field_text => $v,
      );
    }
    $selected = ($default_value == $v[$field_value]) ? ' selected="selected"' : '';
    $ret .= '<option value="'.$v[$field_value].'"'.$selected.'>'.$v[$field_text].'</option>'.PHP_EOL;
  }
  $ret .= '</select>'.PHP_EOL;
  if (self::$enable_show_name) $ret .= '<br><span style="background:yellow">'.$name.'</span>';
  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Radio Array
static function radio_array($p = array(), $echo = true){
  $name = $p['name'] ?? '';
  $preview = FORM::is_preview();
  $default_value = FORM::get_var($name);
  //dd($default_value);
  $data = self::toArray($p['data'] ?? array());
  $out = $data[$default_value] ?? '';

  if ($preview) {
    if ($echo) {
      echo $out;
      return;
    } else {
      return $out;
    }
  }

  $id = $p['id'] ?? $name;
  $toggle_div = $p['toggle_div'] ?? false;
  $toggle_div_by_value = $p['toggle_div_by_value'] ?? [];
  $field_value = $p['field_value'] ?? 'value';
  $field_text = $p['field_text'] ?? 'text';
  $required = $p['required'] ?? false;
  if ($required) FORM::set_has_required();
  $fake_required = (defined('FORCE_DISABLED_REQUIRED') && FORCE_DISABLED_REQUIRED);
  if ($required) {
    if ($fake_required) $required = false;
  } else {
    $fake_required = false;
  }
  $vertical = $p['vertical'] ?? false;

  $buffer = array();
  $no = 0;
  foreach ($data as $v) {
    $no++;
    if (gettype($v) == 'string') {
      $v = array(
        $field_value => $v,
        $field_text => $v,
      );
    }
    $checked = ($default_value == $v[$field_value]) ? ' checked="checked"' : '';
    $temp  = '';
    $temp .= '<input';
    $temp .= ' type="radio"';
    $temp .= ' class="iCheck"';
    $temp .= ' id="'.$name.'_'.$no.'"';
    $temp .= ' name="'.$name.'"';
    $temp .= ' value="'.$v[$field_value].'"';
    if ($required) $temp .= ' required="required"';
    if ($fake_required) $temp .= ' fake_required="fake_required"';
    $temp .= $checked;
    $temp .= '> ';
    $temp .= '<label for="'.$name.'_'.$no.'">'.$v[$field_text].'</label>'.PHP_EOL;

    if (isset($toggle_div_by_value[$v[$field_value]])) {
      $tog = $toggle_div_by_value[$v[$field_value]];
      $tog_id = $tog['id'] ?? '';
      $tog_class = $tog['class'] ?? '';
      $temp .= '<div id="'.$tog_id.'" class="'.$tog_class.'">';
      $temp .= $tog['html'] ?? '';
      $temp .= '</div>';

      self::jquery_ready("
        $('input[name=\"".$name."\"]').on('ifChecked', function(){
          temp_value = $('input[name=\"".$name."\"]:checked').val();
          if (temp_value == '".$v[$field_value]."') {
            $('#".$tog_id."').show();
          } else {
            $('#".$tog_id."').hide();
          }
        });
      ");
    }

    $buffer[] = $temp;
  }
  if ($toggle_div) {
    self::jquery_ready("
      $('input[name=\"".$name."\"]').on('ifChecked', function(){
        temp_value = $('input[name=\"".$name."\"]:checked').val();
        if (temp_value == 'Ya') {
          $('#div_".$name."_ya').show();
        } else {
          $('#div_".$name."_ya').hide();
        }
      });
    ");
  }
  if ($vertical) {
    $ret = implode('<br>', $buffer).PHP_EOL;
  } else {
    $ret = implode(str_repeat(' &nbsp;', 5), $buffer).PHP_EOL;
  }
  if (self::$enable_show_name) $ret .= '<br><span style="background:yellow">'.$name.'</span>';
  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Radio Ya/Tidak
static function radio_ya_tidak($p = array(), $echo = true){
  $p['data'] = [];
  $p['data'][] = [
    'value' => 'Ya',
    'text' => 'Ya',
  ];
  $p['data'][] = [
    'value' => 'Tidak',
    'text' => 'Tidak',
  ];
  if (isset($p['tidak_tahu']) && $p['tidak_tahu']) {
    $p['data'][] = [
      'value' => 'Tidak Tahu',
      'text' => 'Tidak Tahu',
    ];
  }

  $ret = self::radio_array($p, false);

  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Checkbox
static function checkbox($p = array(), $echo = true){
  $name = $p['name'] ?? '';
  $preview = FORM::is_preview();
  $default_value = FORM::get_var($name);
  //dd($default_value);
  $out = $data[$default_value] ?? '';

  if ($preview) {
    if ($echo) {
      echo $out;
      return;
    } else {
      return $out;
    }
  }

  $id = $p['id'] ?? $name;
  $value = $p['value'] ?? '1';
  $required = $p['required'] ?? false;
  if ($required) FORM::set_has_required();
  $fake_required = (defined('FORCE_DISABLED_REQUIRED') && FORCE_DISABLED_REQUIRED);
  if ($required) {
    if ($fake_required) $required = false;
  } else {
    $fake_required = false;
  }
  $caption = $p['caption'] ?? '';
  if ($caption) $caption = ' <label for="'.$id.'">'.$caption.'</label>'.PHP_EOL;

  $buffer = array();
  $buffer[] = 'type="checkbox"';
  $buffer[] = 'class="iCheck"';
  $buffer[] = 'name="'.$name.'"';
  $buffer[] = 'id="'.$id.'"';
  $buffer[] = 'value="'.$value.'"';
  //if ($readonly) $buffer[] = 'readonly="readonly"';
  if ($required) $buffer[] = 'required="required"';
  if ($fake_required) $buffer[] = 'fake_required="fake_required"';
  //if ($disabled) $buffer[] = 'disabled="disabled"';
  if ($default_value == $value) $buffer[] = 'checked="checked"';

  $ret  = '<input '.implode(' ', $buffer).' />'.$caption;
  $ret .= '<input type="hidden" name="_input_type['.$id.']" value="checkbox">';
  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Datepicker
static function datepicker($p = array(), $echo = true){
  $name = $p['name'] ?? '';
  $preview = FORM::is_preview();
  $default_value = FORMAT::date(FORM::get_var($name));
  //dd($default_value);
  $out = $data[$default_value] ?? '';

  if ($preview) {
    if ($echo) {
      echo $out;
      return;
    } else {
      return $out;
    }
  }

  $id = $p['id'] ?? $name;
  $is_inline = $p['inline'] ?? false;
  $placeholder = $p['placeholder'] ?? '';
  $size = $p['size'] ?? '';
  $a_class = (isset($p['class'])) ? ' '.$p['class'] : '';
  $required = $p['required'] ?? false;
  if ($required) FORM::set_has_required();
  $fake_required = (defined('FORCE_DISABLED_REQUIRED') && FORCE_DISABLED_REQUIRED);
  if ($required) {
    if ($fake_required) $required = false;
  } else {
    $fake_required = false;
  }
  $disabled = $p['disabled'] ?? '';

  $buffer = array();
  $buffer[] = 'type="text"';
  $buffer[] = 'class="datepicker input-text form-control'.(($is_inline)?'-inline':'').$a_class.'"';
  $buffer[] = 'name="'.$name.'"';
  $buffer[] = 'id="'.$id.'"';
  $buffer[] = 'placeholder="'.$placeholder.'"';
  if ($size) $buffer[] = 'size="'.$size.'"';
  $buffer[] = 'readonly="readonly"';
  if ($required) $buffer[] = 'required="required"';
  if ($fake_required) $buffer[] = 'fake_required="fake_required"';
  if ($disabled) $buffer[] = 'disabled="disabled"';
  if ($default_value) $buffer[] = 'value="'.$default_value.'"';

  $ret = '
  <div style="max-width:180px">
    <div id="div_datepicker_'.$id.'" class="input-group date div_datepicker">
      <input '.implode(' ', $buffer).' />
      <div class="input-group-addon">
        <span class="fa fa-calendar"></span>
      </div>
      <div class="input-group-addon2"
        onclick="javascript:$(\'#'.$id.'\').datepicker(\'update\', \'\').trigger(\'changeDate\');">
        <span class="fa fa-close" style="color:#ff4848"></span>
      </div>
    </div>
  </div>
  <input type="hidden" name="_input_type['.$id.']" value="date">
  ';

  if (self::$enable_show_name) $ret .= '<span style="background:yellow">'.$name.'</span>';

  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Back
static function back($caption = '', $url = '', $echo = true){
  if (trim($caption) == '') $caption = 'Kembali';
  if (trim($url) == '') {
    $url = 'javascript:window.history.back();';
  } else {
    $url = "javascript:location.href='{$url}';";
  }

  $ret = '<button type="button" class="btn btn-primary" onclick="'.$url.'"><i class="fa fa-chevron-left"></i> '.$caption.'</button>';

  if ($echo) {
    echo $ret;
  } else {
    return $ret;
  }
}

# Add jQuery Ready
static function jquery_ready($s = ''){
  self::$jquery_ready[] = $s;
}

# Show jQuery Ready
static function show_jquery_ready(){
  echo implode(PHP_EOL.PHP_EOL, self::$jquery_ready);
}

}
