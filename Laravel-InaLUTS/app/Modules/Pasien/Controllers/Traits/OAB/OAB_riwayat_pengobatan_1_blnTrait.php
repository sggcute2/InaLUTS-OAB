<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_pengobatan_1_bln;
use BS;
use DT;
use FORMAT;

trait OAB_riwayat_pengobatan_1_blnTrait {
    public function detail_oab_riwayat_pengobatan_1_bln($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_riwayat_pengobatan_1_bln::where('pasien_id', $id)->exists()) {
            OAB_riwayat_pengobatan_1_bln::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_riwayat_pengobatan_1_bln::where('pasien_id', $id)
            ->first();
        $page_title = 'Riwayat Pengobatan Dalam 1 bulan terakhir';
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

    public function update_oab_riwayat_pengobatan_1_bln_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Riwayat Pengobatan Dalam 1 bulan terakhir';

        $data = $request->all();
        $a = [
            'antihipertensi',
            'obat_diabetik',
            'obat_obatan_psikiatri',
            'obat_obatan_copd',
            'obat_obatan_asma',
            'obat_obatan_alergi',
            'obat_obatan_saraf',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Ya') $data[$v.'_ya'] = '';
        }
        OAB_riwayat_pengobatan_1_bln::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_riwayat_pengobatan_1_bln', $id
        );
    }
}
