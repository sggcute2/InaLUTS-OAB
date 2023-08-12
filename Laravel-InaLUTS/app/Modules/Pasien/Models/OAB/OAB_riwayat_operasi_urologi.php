<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_operasi_urologi extends BaseModel
{
    protected $table = 'oab_riwayat_operasi_urologi';
}

$model_table = 'oab_riwayat_operasi_urologi';
OAB_riwayat_operasi_urologi::set_meta(['table' => $model_table]);
