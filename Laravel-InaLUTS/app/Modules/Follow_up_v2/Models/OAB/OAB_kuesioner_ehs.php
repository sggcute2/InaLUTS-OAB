<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_ehs extends BaseModel
{
    protected $table = 'follow_up_v2_oab_kuesioner_ehs';
}

$model_table = 'follow_up_v2_oab_kuesioner_ehs';
OAB_kuesioner_ehs::set_meta(['table' => $model_table]);
