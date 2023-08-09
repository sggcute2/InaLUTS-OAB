<?php

namespace App\Modules\Suku\Models;

use App\Models\BaseModel;

class Suku extends BaseModel
{
    protected $table = 'm_suku';
}

$model_table = 'm_suku';
Suku::set_meta(['table' => $model_table]);
