<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_pengobatan_luts extends BaseModel
{
    protected $table = 'follow_up_v2_oab_riwayat_pengobatan_luts';
}

$model_table = 'follow_up_v2_oab_riwayat_pengobatan_luts';
OAB_riwayat_pengobatan_luts::set_meta(['table' => $model_table]);
