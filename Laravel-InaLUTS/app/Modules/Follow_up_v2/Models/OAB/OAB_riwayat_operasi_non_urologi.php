<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_riwayat_operasi_non_urologi extends BaseModel
{
    protected $table = 'follow_up_v2_oab_riwayat_operasi_non_urologi';
}

$model_table = 'follow_up_v2_oab_riwayat_operasi_non_urologi';
OAB_riwayat_operasi_non_urologi::set_meta(['table' => $model_table]);
