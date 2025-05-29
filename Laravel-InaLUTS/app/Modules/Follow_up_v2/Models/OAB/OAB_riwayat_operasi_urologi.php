<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_operasi_urologi extends BaseModel
{
    protected $table = 'follow_up_v2_oab_riwayat_operasi_urologi';
}

$model_table = 'follow_up_v2_oab_riwayat_operasi_urologi';
OAB_riwayat_operasi_urologi::set_meta(['table' => $model_table]);
