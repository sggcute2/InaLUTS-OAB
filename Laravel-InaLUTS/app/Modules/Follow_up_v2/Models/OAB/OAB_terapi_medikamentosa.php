<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_medikamentosa extends BaseModel
{
    protected $table = 'follow_up_v2_oab_terapi_medikamentosa';
}

$model_table = 'follow_up_v2_oab_terapi_medikamentosa';
OAB_terapi_medikamentosa::set_meta(['table' => $model_table]);
