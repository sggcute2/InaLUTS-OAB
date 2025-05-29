<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_kuesioner_ehs;
use BS;
use DT;
use FORMAT;

trait OAB_kuesioner_ehsTrait {
    public function detail_oab_kuesioner_ehs($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_kuesioner_ehs::where('pasien_id', $id)->where('follow_up_id', $follow_up_id)->exists()) {
            OAB_kuesioner_ehs::base_insert(['pasien_id' => $id, 'follow_up_id' => $follow_up_id]);
        }
        $default = OAB_kuesioner_ehs::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->first();
        $page_title = 'Kuesioner EHS';
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

    public function update_oab_kuesioner_ehs_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Kuesioner EHS';

        $data = $request->all();
        $data['total_score'] =
            ($request->get('score_1', 0));
        OAB_kuesioner_ehs::base_update_by_pasien_id_and_follow_up_id($data, $id, $follow_up_id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_kuesioner_ehs',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }
}
