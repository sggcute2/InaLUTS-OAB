<?php

namespace App\Modules\Follow_up\Models\OAB;

use App\Models\BaseModel;

class OAB_follow_up extends BaseModel
{
    protected $table = 'oab_follow_up';
}

$model_table = 'oab_follow_up';
OAB_follow_up::set_meta(['table' => $model_table]);
