<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_operasi_non_urologi extends BaseModel
{
    protected $table = 'oab_riwayat_operasi_non_urologi';
}

$model_table = 'oab_riwayat_operasi_non_urologi';
OAB_riwayat_operasi_non_urologi::set_meta(['table' => $model_table]);
