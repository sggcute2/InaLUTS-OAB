<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_kuesioner_fsfi;
use BS;
use DT;
use FORMAT;

trait OAB_kuesioner_fsfiTrait {
    public function detail_oab_kuesioner_fsfi($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_kuesioner_fsfi::where('pasien_id', $id)->exists()) {
            OAB_kuesioner_fsfi::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_kuesioner_fsfi::where('pasien_id', $id)
            ->first();
        $page_title = 'Kuesioner FSFI';
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

    public function update_oab_kuesioner_fsfi_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Kuesioner FSFI';

        $data = $request->all();
        $data['total_score'] =
            ($request->get('score_1', 0))
            + ($request->get('score_2', 0))
            + ($request->get('score_3', 0))
            + ($request->get('score_4', 0))
            + ($request->get('score_5', 0))
            + ($request->get('score_6', 0))
            + ($request->get('score_7', 0))
            + ($request->get('score_8', 0))
            + ($request->get('score_9', 0))
            + ($request->get('score_10', 0))
            + ($request->get('score_11', 0))
            + ($request->get('score_12', 0))
            + ($request->get('score_13', 0))
            + ($request->get('score_14', 0))
            + ($request->get('score_15', 0))
            + ($request->get('score_16', 0))
            + ($request->get('score_17', 0))
            + ($request->get('score_18', 0))
            + ($request->get('score_19', 0));
        OAB_kuesioner_fsfi::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_kuesioner_fsfi', $id
        );
    }
}
