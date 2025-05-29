<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_pemeriksaan_imaging extends BaseModel
{
    protected $table = 'follow_up_v2_oab_pemeriksaan_imaging';
}

$model_table = 'follow_up_v2_oab_pemeriksaan_imaging';
OAB_pemeriksaan_imaging::set_meta(['table' => $model_table]);
