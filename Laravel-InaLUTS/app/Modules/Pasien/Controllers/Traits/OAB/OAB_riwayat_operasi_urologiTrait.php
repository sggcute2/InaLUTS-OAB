<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_operasi_urologi;
use BS;
use DT;
use FORMAT;

trait OAB_riwayat_operasi_urologiTrait {
    public function detail_oab_riwayat_operasi_urologi($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_riwayat_operasi_urologi::where('pasien_id', $id)->exists()) {
            OAB_riwayat_operasi_urologi::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_riwayat_operasi_urologi::where('pasien_id', $id)
            ->first();
        $page_title = 'Riwayat operasi / endoskopi urologi';
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

    public function update_oab_riwayat_operasi_urologi_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Riwayat operasi / endoskopi urologi';

        $data = $request->all();
        $a = [
            'tur_prostat',
            'radikal_prostat',
            'rekonstruksi_uretra',
            'tur_buli',
            'operasi_anti_inkontinensia_urine',
            'operasi_pop',
            'injeksi_botox',
            'sistoskopi',
        ];
        foreach($a as $v){
            if ($v == 'operasi_anti_inkontinensia_urine') {
                if (isset($data[$v]) && $data[$v] != 'Ya') {
                    $b = [
                        'sling',
                        'burch_kolposuspensi',
                        'aus',
                        'bulking_agent',
                    ];
                    foreach($b as $vb){
                        $data['c_operasi_anti_inkontinensia_urine_'.$vb] = 0;
                    }
                }
            } else {
                if (isset($data[$v]) && $data[$v] != 'Ya') {
                    $data[$v.'_ya_date'] = null;
                }
            }
        }
        OAB_riwayat_operasi_urologi::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_riwayat_operasi_urologi', $id
        );
    }
}
