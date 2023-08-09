<?php

namespace App\Modules\Jenis_kelamin\Models;

use App\Models\BaseModel;

class Jenis_kelamin extends BaseModel
{
    protected $table = 'm_jenis_kelamin';
}

$model_table = 'm_jenis_kelamin';
Jenis_kelamin::set_meta(['table' => $model_table]);
