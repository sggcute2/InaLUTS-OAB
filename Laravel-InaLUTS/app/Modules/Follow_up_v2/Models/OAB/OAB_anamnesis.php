<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_anamnesis extends BaseModel
{
    protected $table = 'follow_up_v2_oab_anamnesis';
}

$model_table = 'follow_up_v2_oab_anamnesis';
OAB_anamnesis::set_meta(['table' => $model_table]);
