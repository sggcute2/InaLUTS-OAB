<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_penunjang_urodinamik extends BaseModel
{
    protected $table = 'oab_penunjang_urodinamik';
}

$model_table = 'oab_penunjang_urodinamik';
OAB_penunjang_urodinamik::set_meta(['table' => $model_table]);
