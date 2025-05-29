<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_keluhan_tambahan extends BaseModel
{
    protected $table = 'follow_up_v2_oab_keluhan_tambahan';
}

$model_table = 'follow_up_v2_oab_keluhan_tambahan';
OAB_keluhan_tambahan::set_meta(['table' => $model_table]);
