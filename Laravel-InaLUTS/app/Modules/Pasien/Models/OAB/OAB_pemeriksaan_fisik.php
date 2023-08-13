<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_pemeriksaan_fisik extends BaseModel
{
    protected $table = 'oab_pemeriksaan_fisik';
}

$model_table = 'oab_pemeriksaan_fisik';
OAB_pemeriksaan_fisik::set_meta(['table' => $model_table]);
