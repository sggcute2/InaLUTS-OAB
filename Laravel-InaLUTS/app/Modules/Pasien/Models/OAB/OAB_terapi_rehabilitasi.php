<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_rehabilitasi extends BaseModel
{
    protected $table = 'oab_terapi_rehabilitasi';
}

$model_table = 'oab_terapi_rehabilitasi';
OAB_terapi_rehabilitasi::set_meta(['table' => $model_table]);
