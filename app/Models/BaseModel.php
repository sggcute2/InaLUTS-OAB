<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    static protected $meta = [];

    static public function set_meta($meta = []){
        self::$meta = $meta;
    }

    static private function _get_table(){
        if (isset(self::$meta['table'])) {
            return self::$meta['table'];
        } else {
            dd('Error : Table not found');
        }
    }

    static private function _get_fields(){
        if (isset(self::$meta['table'])) {
            $skip_fields = [
                'id',
                /*
                'created_at',
                'created_user_id',
                'created_type_id',
                'updated_at',
                'updated_user_id',
                'updated_type_id',
                */
            ];

            $table = self::$meta['table'];
            $fields = \Schema::getColumnListing($table);
            $ret = [];
            foreach($fields as $field){
                if (!in_array($field, $skip_fields)) $ret[] = $field;
            }

            return $ret;
        } else {
            dd('Error : Table not found');
        }
    }

    static public function base_insert($data = []){
        if (defined('USER_ID') && USER_ID) {
            $data['created_user_id'] = USER_ID;
        }
        if (defined('USER_TYPE') && USER_TYPE) {
            $data['created_user_type'] = USER_TYPE;
        }

        $table = self::_get_table();
        $fields = self::_get_fields();

        $buffer = [];
        foreach($data as $field => $v){
            if (in_array($field, $fields)) {
              $buffer[$field] = $v;
            }
        }

        if ($buffer) {
            return \DB::table($table)->insertGetId($buffer);
        } else {
            return null;
        }
    }

    static public function base_update($data = [], $where = '1=0'){
        if (defined('USER_ID') && USER_ID) {
            $data['updated_user_id'] = USER_ID;
        }
        if (defined('USER_TYPE') && USER_TYPE) {
            $data['updated_user_type'] = USER_TYPE;
        }

        $table = self::_get_table();
        $fields = self::_get_fields();

        $buffer = [];
        foreach($data as $field => $v){
            if (in_array($field, $fields)) {
                if (substr($field, -3) == '_id') {
                    $buffer[$field] = intval($v);
                } else {
                    $buffer[$field] = $v;
                }
            }
        }

        if ($buffer) {
            return \DB::table($table)->whereRaw($where)->update($buffer);
        } else {
            return null;
        }
    }

    static public function base_update_by_id($data = [], $id = 0){
        return self::base_update($data, "id = $id");
    }
}
