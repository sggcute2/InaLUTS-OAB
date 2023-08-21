<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_oabss extends BaseModel
{
    protected $table = 'oab_kuesioner_oabss';
}

$model_table = 'oab_kuesioner_oabss';
OAB_kuesioner_oabss::set_meta(['table' => $model_table]);
