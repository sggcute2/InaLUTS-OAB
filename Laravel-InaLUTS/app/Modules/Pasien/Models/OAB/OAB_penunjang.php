<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_penunjang extends BaseModel
{
    protected $table = 'oab_penunjang';
}

$model_table = 'oab_penunjang';
OAB_penunjang::set_meta(['table' => $model_table]);
