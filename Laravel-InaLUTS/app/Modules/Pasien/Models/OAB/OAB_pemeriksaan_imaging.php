<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_pemeriksaan_imaging extends BaseModel
{
    protected $table = 'oab_pemeriksaan_imaging';
}

$model_table = 'oab_pemeriksaan_imaging';
OAB_pemeriksaan_imaging::set_meta(['table' => $model_table]);
