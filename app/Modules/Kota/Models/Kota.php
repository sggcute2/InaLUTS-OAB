<?php

namespace App\Modules\Kota\Models;

use App\Models\BaseModel;

class Kota extends BaseModel
{
    protected $table = 'm_kota';
}

$model_table = 'm_kota';
Kota::set_meta(['table' => $model_table]);
