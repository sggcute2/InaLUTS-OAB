<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_qol extends BaseModel
{
    protected $table = 'oab_kuesioner_qol';
}

$model_table = 'oab_kuesioner_qol';
OAB_kuesioner_qol::set_meta(['table' => $model_table]);
