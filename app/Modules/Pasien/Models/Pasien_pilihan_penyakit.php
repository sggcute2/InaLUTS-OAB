<?php

namespace App\Modules\Pasien\Models;

use App\Models\BaseModel;
use App\Modules\Registry\Models\Registry;

class Pasien_pilihan_penyakit extends BaseModel
{
    protected $table = 't_pilihan_penyakit';

    public function registry()
    {
        return $this->hasOne(Registry::class, 'id', 'registry_id');
    }
}

$model_table = 't_pilihan_penyakit';
Pasien_pilihan_penyakit::set_meta(['table' => $model_table]);
