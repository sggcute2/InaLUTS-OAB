<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_pemeriksaan_fisik extends BaseModel
{
    protected $table = 'follow_up_v2_oab_pemeriksaan_fisik';
}

$model_table = 'follow_up_v2_oab_pemeriksaan_fisik';
OAB_pemeriksaan_fisik::set_meta(['table' => $model_table]);
