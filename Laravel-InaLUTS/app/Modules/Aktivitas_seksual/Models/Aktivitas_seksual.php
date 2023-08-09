<?php

namespace App\Modules\Aktivitas_seksual\Models;

use App\Models\BaseModel;

class Aktivitas_seksual extends BaseModel
{
    protected $table = 'm_aktivitas_seksual';
}

$model_table = 'm_aktivitas_seksual';
Aktivitas_seksual::set_meta(['table' => $model_table]);
