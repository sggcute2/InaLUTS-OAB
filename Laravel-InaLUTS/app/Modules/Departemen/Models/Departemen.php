<?php

namespace App\Modules\Departemen\Models;

use App\Models\BaseModel;

class Departemen extends BaseModel
{
    protected $table = 'm_departemen';
}

$model_table = 'm_departemen';
Departemen::set_meta(['table' => $model_table]);
