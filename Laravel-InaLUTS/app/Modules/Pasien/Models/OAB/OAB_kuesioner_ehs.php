<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_ehs extends BaseModel
{
    protected $table = 'oab_kuesioner_ehs';
}

$model_table = 'oab_kuesioner_ehs';
OAB_kuesioner_ehs::set_meta(['table' => $model_table]);
