<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_non_operatif extends BaseModel
{
    protected $table = 'follow_up_v2_oab_terapi_non_operatif';
}

$model_table = 'follow_up_v2_oab_terapi_non_operatif';
OAB_terapi_non_operatif::set_meta(['table' => $model_table]);
