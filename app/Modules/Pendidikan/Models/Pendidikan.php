<?php

namespace App\Modules\Pendidikan\Models;

use App\Models\BaseModel;

class Pendidikan extends BaseModel
{
    protected $table = 'm_pendidikan';
}

$model_table = 'm_pendidikan';
Pendidikan::set_meta(['table' => $model_table]);
