<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_terapi;
use BS;
use DT;
use FORMAT;

trait OAB_terapiTrait {
    public function detail_oab_terapi($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_terapi::where('pasien_id', $id)->exists()) {
            OAB_terapi::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_terapi::where('pasien_id', $id)
            ->first();
        $page_title = 'Terapi';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'pasien.update_'.str_replace('detail_', '', $view),
            $id
        );

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                'default' => $default,
                'page_title' => $page_title,
                'form_action' => $form_action,
            ]
        );
    }

    public function update_oab_terapi_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Terapi';

        OAB_terapi::base_update_by_pasien_id($request->all(), $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_terapi', $id
        );
    }
}
