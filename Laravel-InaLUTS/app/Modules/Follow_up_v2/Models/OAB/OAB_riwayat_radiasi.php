<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_radiasi extends BaseModel
{
    protected $table = 'follow_up_v2_oab_riwayat_radiasi';
}

$model_table = 'follow_up_v2_oab_riwayat_radiasi';
OAB_riwayat_radiasi::set_meta(['table' => $model_table]);
