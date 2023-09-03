<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_terapi_operatif_injeksi_botox extends BaseModel
{
    protected $table = 'oab_terapi_operatif_injeksi_botox';
}

$model_table = 'oab_terapi_operatif_injeksi_botox';
OAB_terapi_operatif_injeksi_botox::set_meta(['table' => $model_table]);
