<?php

namespace App\Modules\Kabupaten\Models;

use App\Models\BaseModel;

class Kabupaten extends BaseModel
{
    protected $table = 'm_kabupaten';
}

$model_table = 'm_kabupaten';
Kabupaten::set_meta(['table' => $model_table]);
