<?php

namespace App\Modules\Jaminan_kesehatan\Models;

use App\Models\BaseModel;

class Jaminan_kesehatan extends BaseModel
{
    protected $table = 'm_jaminan_kesehatan';
}

$model_table = 'm_jaminan_kesehatan';
Jaminan_kesehatan::set_meta(['table' => $model_table]);
