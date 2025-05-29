<?php

namespace App\Modules\Follow_up_v2\Models\OAB;

use App\Models\BaseModel;

class OAB_kuesioner_bladder_diary extends BaseModel
{
    protected $table = 'follow_up_v2_oab_kuesioner_bladder_diary';
}

$model_table = 'follow_up_v2_oab_kuesioner_bladder_diary';
OAB_kuesioner_bladder_diary::set_meta(['table' => $model_table]);
