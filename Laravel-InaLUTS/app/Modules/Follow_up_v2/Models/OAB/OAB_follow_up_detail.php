<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_follow_up_detail extends BaseModel
{
    protected $table = 'oab_follow_up_detail';
}

$model_table = 'oab_follow_up_detail';
OAB_follow_up_detail::set_meta(['table' => $model_table]);
