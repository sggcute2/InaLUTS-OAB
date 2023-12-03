<?php

namespace App\Modules\Laporan_follow_up\Models;

use App\Models\BaseModel;
use App\Modules\Rumah_sakit\Models\Rumah_sakit;

class Laporan_follow_up extends BaseModel
{
    protected $table = 'm_follow_up';

    public function rumah_sakit()
    {
        return $this->hasOne(Rumah_sakit::class, 'id', 'rumah_sakit_id');
    }
}

$model_table = 'm_follow_up';
Laporan_follow_up::set_meta(['table' => $model_table]);
