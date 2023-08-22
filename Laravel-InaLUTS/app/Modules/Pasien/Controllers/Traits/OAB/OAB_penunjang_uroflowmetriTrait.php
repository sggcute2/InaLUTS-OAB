<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_penunjang_uroflowmetri;
use BS;
use DT;
use FORMAT;

trait OAB_penunjang_uroflowmetriTrait {
    public function detail_oab_penunjang_uroflowmetri($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_penunjang_uroflowmetri::where('pasien_id', $id)->exists()) {
            OAB_penunjang_uroflowmetri::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_penunjang_uroflowmetri::where('pasien_id', $id)
            ->first();
        $page_title = 'Penunjang - Uroflowmetri';
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

    public function update_oab_penunjang_uroflowmetri_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Penunjang - Uroflowmetri';

        $data = $request->all();
        $a = [
            'voided_volume',
            'q_max',
            'q_ave',
            'pvr',
            'voiding_time',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Ya') {
                $data[$v.'_ya_date'] = null;
                $data[$v.'_ya'] = '';
            }
        }
        OAB_penunjang_uroflowmetri::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_penunjang_uroflowmetri', $id
        );
    }
}
