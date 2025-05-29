<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_penunjang;
use BS;
use DT;
use FORMAT;

trait OAB_penunjangTrait {
    public function detail_oab_penunjang($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_penunjang::where('pasien_id', $id)->where('follow_up_id', $follow_up_id)->exists()) {
            OAB_penunjang::base_insert(['pasien_id' => $id, 'follow_up_id' => $follow_up_id]);
        }
        $default = OAB_penunjang::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->first();
        $page_title = 'Penunjang';
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

    public function update_oab_penunjang_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Penunjang';

        $data = $request->all();
        if (isset($data['upp']) && $data['upp'] != 'Dikerjakan') {
            $data['maximal_urethral_pressure'] = '';
            $data['functional_urethral_length'] = '';
        }
        if (isset($data['sistoskopi']) && $data['sistoskopi'] != 'Dikerjakan') {
            $data['mukosa_buli'] = '';
            $data['trabekulasi'] = '';
            $data['sakulasi_divertikel'] = '';
            $data['kapasitas_buli'] = '';
            $data['batu'] = '';
            $data['tumor'] = '';
            $data['lobus_medius'] = '';
            $data['kissing_lobe'] = '';
            $data['muara_ureter'] = '';
            $data['urethra'] = '';
            $data['mue'] = '';
            $data['lichen_schlerosis'] = '';
        }
        OAB_penunjang::base_update_by_pasien_id_and_follow_up_id($data, $id, $follow_up_id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_penunjang',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }
}
