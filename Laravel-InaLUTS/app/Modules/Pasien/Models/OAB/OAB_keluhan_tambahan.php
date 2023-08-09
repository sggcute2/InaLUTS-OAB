<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_keluhan_tambahan extends BaseModel
{
    protected $table = 'oab_keluhan_tambahan';
}

$model_table = 'oab_keluhan_tambahan';
OAB_keluhan_tambahan::set_meta(['table' => $model_table]);
