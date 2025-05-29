<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_faktor_resiko extends BaseModel
{
    protected $table = 'follow_up_v2_oab_faktor_resiko';
}

$model_table = 'follow_up_v2_oab_faktor_resiko';
OAB_faktor_resiko::set_meta(['table' => $model_table]);
