<?php

namespace App\Modules\Unit_pelayanan\Models;

use App\Models\BaseModel;

class Unit_pelayanan extends BaseModel
{
    protected $table = 'm_unit_pelayanan';
}

$model_table = 'm_unit_pelayanan';
Unit_pelayanan::set_meta(['table' => $model_table]);
