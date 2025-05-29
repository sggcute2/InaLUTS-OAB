<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_penunjang extends BaseModel
{
    protected $table = 'follow_up_v2_oab_penunjang';
}

$model_table = 'follow_up_v2_oab_penunjang';
OAB_penunjang::set_meta(['table' => $model_table]);
