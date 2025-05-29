<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_pemeriksaan_imaging;
use BS;
use DT;
use FORMAT;

trait OAB_pemeriksaan_imagingTrait {
    public function detail_oab_pemeriksaan_imaging($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_pemeriksaan_imaging::where('pasien_id', $id)->where('follow_up_id', $follow_up_id)->exists()) {
            OAB_pemeriksaan_imaging::base_insert(['pasien_id' => $id, 'follow_up_id' => $follow_up_id]);
        }
        $default = OAB_pemeriksaan_imaging::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->first();
        $page_title = 'Pemeriksaan Imaging';
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

    public function update_oab_pemeriksaan_imaging_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan Imaging';

        $data = $request->all();
        if (isset($data['usg']) && $data['usg'] != 'Dilakukan') {
            $data['usg_date'] = null;
        }
        OAB_pemeriksaan_imaging::base_update_by_pasien_id_and_follow_up_id($data, $id, $follow_up_id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_pemeriksaan_imaging',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }
}
