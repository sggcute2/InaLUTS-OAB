<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_ipss extends BaseModel
{
    protected $table = 'follow_up_v2_oab_kuesioner_ipss';
}

$model_table = 'follow_up_v2_oab_kuesioner_ipss';
OAB_kuesioner_ipss::set_meta(['table' => $model_table]);
