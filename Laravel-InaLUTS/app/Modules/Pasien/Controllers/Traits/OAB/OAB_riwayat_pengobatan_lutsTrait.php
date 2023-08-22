<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_pengobatan_luts;
use BS;
use DT;
use FORMAT;

trait OAB_riwayat_pengobatan_lutsTrait {
    public function detail_oab_riwayat_pengobatan_luts($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_riwayat_pengobatan_luts::where('pasien_id', $id)->exists()) {
            OAB_riwayat_pengobatan_luts::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_riwayat_pengobatan_luts::where('pasien_id', $id)
            ->first();
        $page_title = 'Riwayat Pengobatan LUTS sebelumnya';
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

    public function update_oab_riwayat_pengobatan_luts_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Riwayat Pengobatan LUTS sebelumnya';

        $data = $request->all();
        $a = [
            'tamsulosin',
            'alfuzosin',
            'doxazosin',
            'terazosin',
            'silodosin',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Ya') {
                $data[$v.'_hari'] = 0;
                $data[$v.'_bulan'] = 0;
                $data[$v.'_tahun'] = 0;
            }
        }
        if (isset($data['pde_5_inhibitor']) && $data['pde_5_inhibitor'] == 'Ya') {
            if (
                isset($data['pde_5_inhibitor'])
                && $data['pde_5_inhibitor'] != 'Ya'
            ) {
                $data['tadalafil_bulan'] = 0;
            }
        } else {
            $data['tadalafil'] = '';
            $data['tadalafil_bulan'] = 0;
        }
        $a = [
            'finasteride',
            'dutasteride',
            'solifenacin',
            'imidafenacin',
            'tolterodine',
            'propiverine',
            'flavoxate',
            'mirabegron',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Ya') {
                $data[$v.'_bulan'] = 0;
            }
        }
        OAB_riwayat_pengobatan_luts::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_riwayat_pengobatan_luts', $id
        );
    }
}
