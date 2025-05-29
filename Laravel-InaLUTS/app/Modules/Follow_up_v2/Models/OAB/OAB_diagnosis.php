<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_diagnosis extends BaseModel
{
    protected $table = 'follow_up_v2_oab_diagnosis';
}

$model_table = 'follow_up_v2_oab_diagnosis';
OAB_diagnosis::set_meta(['table' => $model_table]);
