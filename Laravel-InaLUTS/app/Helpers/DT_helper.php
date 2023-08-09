<?php
class DT {

static $views = array();

static function toArray($obj){
  return json_decode(json_encode($obj), true);
}

static function add($name = false, $data = null, $column = array()){
  if (!$name) $name = 'default';
  self::$views[$name] = array($data, $column);
}

static function view($name = false){
  if (!$name) $name = 'default';
  $dv = self::$views[$name];
  $data = self::toArray($dv[0]);
  $column = $dv[1];
?>
<table class="table table-bordered table-striped datatables">
  <thead>
    <tr>
      <th scope="col">#</th>
<?php
  foreach($column as $v){
?>
      <th scope="col"><?php echo $v[0] ?></th>
<?php
  }
?>
    </tr>
  </thead>
  <tbody>
<?php
  $n = 0;
  foreach($data as $dv){
    $n++;
?>
    <tr>
      <td><?php echo $n ?></td>
<?php
    foreach($column as $c){
      $out = '';
      if (isset($c[1]) && $c[1] instanceof Closure) {
        $out = call_user_func_array($c[1], array($dv));
      } else if (isset($c[2]) && $c[2] instanceof Closure) {
        $out = call_user_func_array($c[2], array($dv[$c[1]], $dv));
      } else {
        $out = $dv[$c[1]];
      }
?>
      <td><?php echo $out ?></td>
<?php
    }
?>
    </tr>
<?php
  }
?>
  </tbody>
</table>
<?php
}

}
