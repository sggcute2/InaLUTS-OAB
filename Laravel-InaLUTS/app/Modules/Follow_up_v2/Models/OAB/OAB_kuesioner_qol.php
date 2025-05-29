<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_qol extends BaseModel
{
    protected $table = 'follow_up_v2_oab_kuesioner_qol';
}

$model_table = 'follow_up_v2_oab_kuesioner_qol';
OAB_kuesioner_qol::set_meta(['table' => $model_table]);
