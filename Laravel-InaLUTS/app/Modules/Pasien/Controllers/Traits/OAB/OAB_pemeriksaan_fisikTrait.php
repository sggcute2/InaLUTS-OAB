<?php

namespace App\Modules\Pasien\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_pemeriksaan_fisik;
use BS;
use DT;
use FORMAT;

trait OAB_pemeriksaan_fisikTrait {
    public function detail_oab_pemeriksaan_fisik($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_pemeriksaan_fisik::where('pasien_id', $id)->exists()) {
            OAB_pemeriksaan_fisik::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_pemeriksaan_fisik::where('pasien_id', $id)
            ->first();
        $page_title = 'Pemeriksaan fisik';
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

    public function update_oab_pemeriksaan_fisik_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan fisik';

        $data = $request->all();
        $a = [
            'gangguan_neurologi',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Ya') {
                $b = [
                    'tremor',
                    'fascial_palsy',
                    'hemiparesis',
                    'paraparesis',
                    'tetraparesis',
                    'hemiplegi',
                    'paraplegi',
                ];
                foreach($b as $vb){
                    $data['c_'.$v.'_'.$vb] = 0;
                }
            }
        }
        $a = [
            'pop',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Ya') {
                $data[$v.'_ya'] = '';
            }
        }
        $a = [
            'uretra',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Tidak') {
                $b = [
                    'caruncle',
                    'stenosis',
                ];
                foreach($b as $vb){
                    $data['c_'.$v.'_'.$vb] = 0;
                }
            }
        }
        $a = [
            'prostat',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Tidak') {
                $data[$v.'_tidak'] = '';
            }
        }
        OAB_pemeriksaan_fisik::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_pemeriksaan_fisik', $id
        );
    }
}
