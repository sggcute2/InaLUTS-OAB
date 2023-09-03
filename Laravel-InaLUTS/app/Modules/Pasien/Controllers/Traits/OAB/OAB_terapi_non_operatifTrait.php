<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_terapi_non_operatif;
use BS;
use DT;
use FORMAT;

trait OAB_terapi_non_operatifTrait {
    public function detail_oab_terapi_non_operatif($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_terapi_non_operatif::where('pasien_id', $id)->exists()) {
            OAB_terapi_non_operatif::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_terapi_non_operatif::where('pasien_id', $id)
            ->first();
        $page_title = 'Terapi Non-Operatif';
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

    public function update_oab_terapi_non_operatif_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Terapi Non-Operatif';

        $data = $request->all();
        if (isset($data['tatalaksana_non_operatif']) && $data['tatalaksana_non_operatif'] != 'Ya') {
            $b = [
                'kateter_menetap',
                'kateter_berkala',
                'penggunaan_diapers',
                'penile_clamp',
                'kondom_kateter',
            ];
            foreach($b as $vb){
                $data[$vb] = '';
            }
        }
        OAB_terapi_non_operatif::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_terapi_non_operatif', $id
        );
    }
}
