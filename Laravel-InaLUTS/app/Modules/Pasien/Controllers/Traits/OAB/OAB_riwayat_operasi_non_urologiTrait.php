<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_operasi_non_urologi;
use BS;
use DT;
use FORMAT;

trait OAB_riwayat_operasi_non_urologiTrait {
    public function detail_oab_riwayat_operasi_non_urologi($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_riwayat_operasi_non_urologi::where('pasien_id', $id)->exists()) {
            OAB_riwayat_operasi_non_urologi::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_riwayat_operasi_non_urologi::where('pasien_id', $id)
            ->first();
        $page_title = 'Riwayat Operasi Non Urologi';
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

    public function update_oab_riwayat_operasi_non_urologi_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Riwayat Operasi Non Urologi';

        $data = $request->all();
        $a = [
            'operasi_tulang_belakang',
            'operasi_area_pelvik',
            'operasi_di_daerah_pelvis',
            'operasi_kraniotomi',
        ];
        foreach($a as $v){
            if ($v == 'operasi_di_daerah_pelvis') {
                if (isset($data[$v]) && $data[$v] != 'Ya') {
                    $b = [
                        'histrektomi',
                        'miomektomi',
                        'kistektomi',
                        'salfingo_ovorektomi',
                        'operasi_ca_colorektal',
                    ];
                    foreach($b as $vb){
                        $data['c_operasi_di_daerah_pelvis_'.$vb] = 0;
                    }
                }
            } else {
                if (isset($data[$v]) && $data[$v] != 'Ya') {
                    //
                }
            }
        }
        OAB_riwayat_operasi_non_urologi::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_riwayat_operasi_non_urologi', $id
        );
    }
}
