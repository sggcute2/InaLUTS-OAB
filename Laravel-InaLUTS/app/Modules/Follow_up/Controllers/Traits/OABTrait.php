<?php

namespace App\Modules\Follow_up\Controllers\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
/*
use App\Modules\Follow_up\Controllers\Traits\OAB\{
    OAB_terapi_operatifTrait,
};
*/
use BS;
use DT;
use FORMAT;

trait OABTrait {

    //use OAB_terapi_operatifTrait;

    public function detail_oab($pasien_id, $id): View
    {
        echo '$pasien_id = '.$pasien_id.' , $id = '.$id;exit;
    }

}
