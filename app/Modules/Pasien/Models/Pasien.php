<?php

namespace App\Modules\Pasien\Models;

use App\Models\BaseModel;

class Pasien extends BaseModel
{
    protected $table = 'm_pasien';
}

$model_table = 'm_pasien';
Pasien::set_meta(['table' => $model_table]);
