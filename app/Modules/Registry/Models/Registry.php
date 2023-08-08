<?php

namespace App\Modules\Registry\Models;

use App\Models\BaseModel;

class Registry extends BaseModel
{
    protected $table = 'm_registry';
}

$model_table = 'm_registry';
Registry::set_meta(['table' => $model_table]);
