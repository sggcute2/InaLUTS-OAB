<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_iief extends BaseModel
{
    protected $table = 'oab_kuesioner_iief';
}

$model_table = 'oab_kuesioner_iief';
OAB_kuesioner_iief::set_meta(['table' => $model_table]);
