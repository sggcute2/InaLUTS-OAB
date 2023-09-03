<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_non_operatif extends BaseModel
{
    protected $table = 'oab_terapi_non_operatif';
}

$model_table = 'oab_terapi_non_operatif';
OAB_terapi_non_operatif::set_meta(['table' => $model_table]);
