<?php

namespace App\Modules\Datang\Models;

use App\Models\BaseModel;

class Datang extends BaseModel
{
    protected $table = 'm_datang';
}

$model_table = 'm_datang';
Datang::set_meta(['table' => $model_table]);
