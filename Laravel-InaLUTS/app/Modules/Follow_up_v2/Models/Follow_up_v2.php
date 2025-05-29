<?php

namespace App\Modules\Follow_up_v2\Models;

use App\Models\BaseModel;

class Follow_up_v2 extends BaseModel
{
    protected $table = 'm_follow_up';
}

$model_table = 'm_follow_up';
Follow_up_v2::set_meta(['table' => $model_table]);
