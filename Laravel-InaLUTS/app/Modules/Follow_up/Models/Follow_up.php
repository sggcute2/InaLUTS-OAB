<?php

namespace App\Modules\Follow_up\Models;

use App\Models\BaseModel;

class Follow_up extends BaseModel
{
    protected $table = 'm_follow_up';
}

$model_table = 'm_follow_up';
Follow_up::set_meta(['table' => $model_table]);
