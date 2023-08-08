<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_faktor_resiko extends BaseModel
{
    protected $table = 'oab_faktor_resiko';
}

$model_table = 'oab_faktor_resiko';
OAB_faktor_resiko::set_meta(['table' => $model_table]);
