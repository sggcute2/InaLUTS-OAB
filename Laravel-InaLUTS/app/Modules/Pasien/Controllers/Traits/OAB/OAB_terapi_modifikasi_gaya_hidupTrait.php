<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_terapi_modifikasi_gaya_hidup;
use BS;
use DT;
use FORMAT;

trait OAB_terapi_modifikasi_gaya_hidupTrait {
    public function detail_oab_terapi_modifikasi_gaya_hidup($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_terapi_modifikasi_gaya_hidup::where('pasien_id', $id)->exists()) {
            OAB_terapi_modifikasi_gaya_hidup::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_terapi_modifikasi_gaya_hidup::where('pasien_id', $id)
            ->first();
        $page_title = 'Terapi Modifikasi Gaya Hidup';
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

    public function update_oab_terapi_modifikasi_gaya_hidup_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Terapi Modifikasi Gaya Hidup';

        $data = $request->all();
        if (isset($data['bladder_training']) && $data['bladder_training'] != 'Ya') {
            $b = [
                'timed_voiding',
                'timed_voiding_berkemih_spontan',
                'timed_voiding_katerisasi',
                'prompt_voiding',
                'urge_suppression_strategies',
            ];
            foreach($b as $vb){
                $data['c_bladder_training_'.$vb] = 0;
            }
        } else {
            // Ya
            if (isset($data['c_bladder_training_timed_voiding']) && $data['c_bladder_training_timed_voiding'] != '1') {
                $b = [
                    'timed_voiding_berkemih_spontan',
                    'timed_voiding_katerisasi',
                ];
                foreach($b as $vb){
                    $data['c_bladder_training_'.$vb] = 0;
                }
            }
        }
        OAB_terapi_modifikasi_gaya_hidup::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_terapi_modifikasi_gaya_hidup', $id
        );
    }
}
