<?php

namespace App\Modules\Follow_up\Models\OAB;

use App\Models\BaseModel;

class OAB_follow_up_pemeriksaan_laboratorium extends BaseModel
{
    protected $table = 'oab_follow_up_pemeriksaan_laboratorium';
}

$model_table = 'oab_follow_up_pemeriksaan_laboratorium';
OAB_follow_up_pemeriksaan_laboratorium::set_meta(['table' => $model_table]);
