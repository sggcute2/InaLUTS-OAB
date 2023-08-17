<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_pemeriksaan_laboratorium extends BaseModel
{
    protected $table = 'oab_pemeriksaan_laboratorium';
}

$model_table = 'oab_pemeriksaan_laboratorium';
OAB_pemeriksaan_laboratorium::set_meta(['table' => $model_table]);
