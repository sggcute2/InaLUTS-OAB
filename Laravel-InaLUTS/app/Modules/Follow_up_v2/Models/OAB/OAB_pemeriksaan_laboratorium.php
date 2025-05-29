<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_pemeriksaan_laboratorium extends BaseModel
{
    protected $table = 'follow_up_v2_oab_pemeriksaan_laboratorium';
}

$model_table = 'follow_up_v2_oab_pemeriksaan_laboratorium';
OAB_pemeriksaan_laboratorium::set_meta(['table' => $model_table]);
