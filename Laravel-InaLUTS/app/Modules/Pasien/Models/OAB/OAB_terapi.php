<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi extends BaseModel
{
    protected $table = 'oab_terapi';
}

$model_table = 'oab_terapi';
OAB_terapi::set_meta(['table' => $model_table]);
