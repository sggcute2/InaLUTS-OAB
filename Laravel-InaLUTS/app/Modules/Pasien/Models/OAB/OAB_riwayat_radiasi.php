<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_radiasi extends BaseModel
{
    protected $table = 'oab_riwayat_radiasi';
}

$model_table = 'oab_riwayat_radiasi';
OAB_riwayat_radiasi::set_meta(['table' => $model_table]);
