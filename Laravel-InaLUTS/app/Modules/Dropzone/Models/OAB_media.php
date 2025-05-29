<?php

namespace App\Modules\Dropzone\Models;

use App\Models\BaseModel;

class OAB_media extends BaseModel
{
    protected $table = 'oab_media';
}

$model_table = 'oab_media';
OAB_media::set_meta(['table' => $model_table]);
