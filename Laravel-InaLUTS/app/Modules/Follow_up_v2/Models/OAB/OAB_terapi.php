<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi extends BaseModel
{
    protected $table = 'follow_up_v2_oab_terapi';
}

$model_table = 'follow_up_v2_oab_terapi';
OAB_terapi::set_meta(['table' => $model_table]);
