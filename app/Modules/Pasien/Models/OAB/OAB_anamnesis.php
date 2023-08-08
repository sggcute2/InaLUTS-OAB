<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_anamnesis extends BaseModel
{
    protected $table = 'oab_anamnesis';
}

$model_table = 'oab_anamnesis';
OAB_anamnesis::set_meta(['table' => $model_table]);
