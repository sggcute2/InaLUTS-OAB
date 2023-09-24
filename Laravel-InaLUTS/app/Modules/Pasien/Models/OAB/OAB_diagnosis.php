<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_diagnosis extends BaseModel
{
    protected $table = 'oab_diagnosis';
}

$model_table = 'oab_diagnosis';
OAB_diagnosis::set_meta(['table' => $model_table]);
