<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_medikamentosa extends BaseModel
{
    protected $table = 'oab_terapi_medikamentosa';
}

$model_table = 'oab_terapi_medikamentosa';
OAB_terapi_medikamentosa::set_meta(['table' => $model_table]);
