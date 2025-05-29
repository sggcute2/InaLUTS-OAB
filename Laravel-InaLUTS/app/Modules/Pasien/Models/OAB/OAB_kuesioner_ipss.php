<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_ipss extends BaseModel
{
    protected $table = 'oab_kuesioner_ipss';
}

$model_table = 'oab_kuesioner_ipss';
OAB_kuesioner_ipss::set_meta(['table' => $model_table]);
