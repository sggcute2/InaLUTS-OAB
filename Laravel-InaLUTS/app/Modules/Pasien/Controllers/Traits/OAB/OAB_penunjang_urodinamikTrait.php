<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_penunjang_urodinamik;
use BS;
use DT;
use FORMAT;

trait OAB_penunjang_urodinamikTrait {
    public function detail_oab_penunjang_urodinamik($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_penunjang_urodinamik::where('pasien_id', $id)->exists()) {
            OAB_penunjang_urodinamik::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_penunjang_urodinamik::where('pasien_id', $id)
            ->first();
        $page_title = 'Penunjang - urodinamik';
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

    public function update_oab_penunjang_urodinamik_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Penunjang - urodinamik';

        $data = $request->all();
        if (isset($data['pemeriksaan_urodinamik']) && $data['pemeriksaan_urodinamik'] != 'Ya') {
            $data['pemeriksaan_urodinamik_ya_date'] = null;
            $data['kapasitas_kandung_kemih_1'] = '';
            $data['kapasitas_kandung_kemih_2'] = '';
            $data['compliance'] = '';
            $data['detrusor_overactivity'] = '';
            $data['detrusor_overactivity_incontinence'] = '';
            $data['urodynamic_stress_urinary_incontinence'] = '';
            $data['obstruksi_infravesical'] = '';
            $data['detrusor_underactivity'] = '';
            $data['disfunctional_voiding'] = '';
            $data['pvr_1'] = '';
            $data['pvr_2'] = '';
        }
        OAB_penunjang_urodinamik::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_penunjang_urodinamik', $id
        );
    }
}
