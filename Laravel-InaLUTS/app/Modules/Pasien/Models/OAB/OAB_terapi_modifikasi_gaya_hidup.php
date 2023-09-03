<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_modifikasi_gaya_hidup extends BaseModel
{
    protected $table = 'oab_terapi_modifikasi_gaya_hidup';
}

$model_table = 'oab_terapi_modifikasi_gaya_hidup';
OAB_terapi_modifikasi_gaya_hidup::set_meta(['table' => $model_table]);
