<?php

namespace App\Modules\Dropzone\Models;

use App\Models\BaseModel;

class OAB_media_follow_up_v2 extends BaseModel
{
    protected $table = 'follow_up_v2_oab_media';
}

$model_table = 'follow_up_v2_oab_media';
OAB_media_follow_up_v2::set_meta(['table' => $model_table]);
