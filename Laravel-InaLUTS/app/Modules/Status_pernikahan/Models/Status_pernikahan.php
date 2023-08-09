<?php

namespace App\Modules\Status_pernikahan\Models;

use App\Models\BaseModel;

class Status_pernikahan extends BaseModel
{
    protected $table = 'm_status_pernikahan';
}

$model_table = 'm_status_pernikahan';
Status_pernikahan::set_meta(['table' => $model_table]);
