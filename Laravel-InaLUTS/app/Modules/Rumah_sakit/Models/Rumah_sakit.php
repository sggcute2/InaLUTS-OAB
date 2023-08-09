<?php

namespace App\Modules\Rumah_sakit\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\BaseModel;
use App\Modules\Kota\Models\Kota;

class Rumah_sakit extends BaseModel
{
    protected $table = 'm_rumah_sakit';

    public function kota(): HasOne
    {
        return $this->hasOne(Kota::class, 'kota_id', 'id');
    }
}

$model_table = 'm_rumah_sakit';
Rumah_sakit::set_meta(['table' => $model_table]);
