<?php

namespace App\Modules\Pasien\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_bladder_diary extends BaseModel
{
    protected $table = 'oab_kuesioner_bladder_diary';
}

$model_table = 'oab_kuesioner_bladder_diary';
OAB_kuesioner_bladder_diary::set_meta(['table' => $model_table]);
