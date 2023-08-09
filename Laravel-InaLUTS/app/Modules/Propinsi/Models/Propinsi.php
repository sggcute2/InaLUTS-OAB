<?php

namespace App\Modules\Propinsi\Models;

use App\Models\BaseModel;

class Propinsi extends BaseModel
{
    protected $table = 'm_propinsi';
}

$model_table = 'm_propinsi';
Propinsi::set_meta(['table' => $model_table]);
