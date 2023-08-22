<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_fsfi extends BaseModel
{
    protected $table = 'oab_kuesioner_fsfi';
}

$model_table = 'oab_kuesioner_fsfi';
OAB_kuesioner_fsfi::set_meta(['table' => $model_table]);
