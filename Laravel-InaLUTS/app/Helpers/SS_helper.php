<?php
class SS {

static $data = array();

static function set($name, $value){
  self::$data[$name] = $value;
}

static function get($name){
  return self::$data[$name] ?? NULL;
}

}
