<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_penunjang_uroflowmetri extends BaseModel
{
    protected $table = 'oab_penunjang_uroflowmetri';
}

$model_table = 'oab_penunjang_uroflowmetri';
OAB_penunjang_uroflowmetri::set_meta(['table' => $model_table]);
