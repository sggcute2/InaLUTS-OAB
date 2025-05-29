<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_sistem_skor extends BaseModel
{
    protected $table = 'follow_up_v2_oab_sistem_skor';
}

$model_table = 'follow_up_v2_oab_sistem_skor';
OAB_sistem_skor::set_meta(['table' => $model_table]);
