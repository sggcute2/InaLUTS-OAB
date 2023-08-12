<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_sistem_skor extends BaseModel
{
    protected $table = 'oab_sistem_skor';
}

$model_table = 'oab_sistem_skor';
OAB_sistem_skor::set_meta(['table' => $model_table]);
