<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_operatif extends BaseModel
{
    protected $table = 'follow_up_v2_oab_terapi_operatif';
}

$model_table = 'follow_up_v2_oab_terapi_operatif';
OAB_terapi_operatif::set_meta(['table' => $model_table]);
