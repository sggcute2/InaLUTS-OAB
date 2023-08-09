<?php

namespace App\Modules\Dokter_pemeriksa\Models;

use App\Models\BaseModel;

class Dokter_pemeriksa extends BaseModel
{
    protected $table = 'm_dokter_pemeriksa';
}

$model_table = 'm_dokter_pemeriksa';
Dokter_pemeriksa::set_meta(['table' => $model_table]);
