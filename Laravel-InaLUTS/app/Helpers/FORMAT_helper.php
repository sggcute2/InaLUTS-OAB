<?php
class FORMAT {

# Date
static function date($dt = '') {
  // YYYY-MM-DD
  $ret = '';
  if ($dt == '0000-00-00') $dt = '';
  $x = explode('-', $dt);
  if (count($x) == 3) {
    $y = $x[0] * 1;
    $m = $x[1] * 1;
    $d = $x[2] * 1;
    $ret .= ($d < 10) ? '0'.$d : $d;
    $ret .= '-';
    $ret .= ($m < 10) ? '0'.$m : $m;
    $ret .= '-';
    $ret .= $y;
  }

  return $ret;
}

# Date from Datepicker
static function date_from_datepicker($dt = ''){
  // DD-MM-YYYY
  $ret = null;
  $x = explode('-', $dt);
  if (count($x) == 3) {
    $d = $x[0] * 1;
    $m = $x[1] * 1;
    $y = $x[2] * 1;
    $ret .= $y;
    $ret .= '-';
    $ret .= ($m < 10) ? '0'.$m : $m;
    $ret .= '-';
    $ret .= ($d < 10) ? '0'.$d : $d;
  }

  return $ret;
}

# Sanitize filename
static function sanitize_filename($filename = '') {
  $filename = preg_replace(
    '~
    [<>:"/\\|?*]|          # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
    [\x00-\x1F]|           # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
    [\x7F\xA0\xAD]|        # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
    [#\[\]@!$&\'()+,;=]|   # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
    [{}^\~`]               # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
    ~x',
    '_',
    $filename
  );

  // avoids ".", ".." or ".hiddenFiles"
  $filename = ltrim($filename, '.-');

  // replace space with underscore
  $filename = str_replace(' ', '_', $filename);

  // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');

  return $filename;
}

# Convert column number to Letter column for excel
static function excel_column($n = 1){
  $f = (int) ($n / 26);
  $m = $n % 26;
  if ($n > 26 && $m == 0) {
    $f--;
    $m = 26;
  }
  return ($n > 26) ? chr(64 + $f).chr(64 + $m) : chr(64 + $n);
}

}
