<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_pengobatan_luts extends BaseModel
{
    protected $table = 'oab_riwayat_pengobatan_luts';
}

$model_table = 'oab_riwayat_pengobatan_luts';
OAB_riwayat_pengobatan_luts::set_meta(['table' => $model_table]);
