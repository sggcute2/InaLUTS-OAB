<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_kuesioner_oabss;
use BS;
use DT;
use FORMAT;

trait OAB_kuesioner_oabssTrait {
    public function detail_oab_kuesioner_oabss($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_kuesioner_oabss::where('pasien_id', $id)->where('follow_up_id', $follow_up_id)->exists()) {
            OAB_kuesioner_oabss::base_insert(['pasien_id' => $id, 'follow_up_id' => $follow_up_id]);
        }
        $default = OAB_kuesioner_oabss::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->first();
        $page_title = 'Kuesioner OABSS';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'follow_up_v2.update_'.str_replace('detail_', '', $view),
            ['id' => $id, 'follow_up_id' => $follow_up_id]
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

    public function update_oab_kuesioner_oabss_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Kuesioner OABSS';

        $data = $request->all();
        $data['total_score'] =
            ($request->get('score_1', 0))
            + ($request->get('score_2', 0))
            + ($request->get('score_3', 0))
            + ($request->get('score_4', 0));
        OAB_kuesioner_oabss::base_update_by_pasien_id_and_follow_up_id($data, $id, $follow_up_id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_kuesioner_oabss',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }
}
