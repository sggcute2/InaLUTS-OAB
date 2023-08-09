<?php

namespace App\Modules\Pasien\Models;

use App\Models\BaseModel;
use App\Modules\Rumah_sakit\Models\Rumah_sakit;

class Pasien extends BaseModel
{
    protected $table = 'm_pasien';

    public function rumah_sakit()
    {
        return $this->hasOne(Rumah_sakit::class, 'id', 'rumah_sakit_id');
    }
}

$model_table = 'm_pasien';
Pasien::set_meta(['table' => $model_table]);
