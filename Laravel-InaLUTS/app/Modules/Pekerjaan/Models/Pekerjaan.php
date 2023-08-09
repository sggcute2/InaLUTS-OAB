<?php

namespace App\Modules\Pekerjaan\Models;

use App\Models\BaseModel;

class Pekerjaan extends BaseModel
{
    protected $table = 'm_pekerjaan';
}

$model_table = 'm_pekerjaan';
Pekerjaan::set_meta(['table' => $model_table]);
