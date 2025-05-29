<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_rehabilitasi extends BaseModel
{
    protected $table = 'follow_up_v2_oab_terapi_rehabilitasi';
}

$model_table = 'follow_up_v2_oab_terapi_rehabilitasi';
OAB_terapi_rehabilitasi::set_meta(['table' => $model_table]);
