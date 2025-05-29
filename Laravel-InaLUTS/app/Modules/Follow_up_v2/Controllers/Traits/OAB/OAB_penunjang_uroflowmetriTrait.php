<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_penunjang_uroflowmetri;
use BS;
use DT;
use FORMAT;

trait OAB_penunjang_uroflowmetriTrait {
    public function detail_oab_penunjang_uroflowmetri($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_penunjang_uroflowmetri::where('pasien_id', $id)->where('follow_up_id', $follow_up_id)->exists()) {
            OAB_penunjang_uroflowmetri::base_insert(['pasien_id' => $id, 'follow_up_id' => $follow_up_id]);
        }
        $default = OAB_penunjang_uroflowmetri::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->first();

        $active_tab = 0;
        $first_id = 0;
        $temp = OAB_penunjang_uroflowmetri::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->orderBy('id', 'ASC')
            ->get();
        $default_by_id = [];
        foreach($temp as $vt){
            $tid = $vt->id;
            if (!$first_id) $first_id = $vt->id;

            $vt->{'tgl_'.$tid.'_date'} = $vt->tgl_date;
            $vt->{'voided_volume_'.$tid} = $vt->voided_volume;
            $vt->{'voided_volume_'.$tid.'_ya_date'} = $vt->voided_volume_ya_date;
            $vt->{'voided_volume_'.$tid.'_ya'} = $vt->voided_volume_ya;
            $vt->{'q_max_'.$tid} = $vt->q_max;
            $vt->{'q_max_'.$tid.'_ya_date'} = $vt->q_max_ya_date;
            $vt->{'q_max_'.$tid.'_ya'} = $vt->q_max_ya;
            $vt->{'q_ave_'.$tid} = $vt->q_ave;
            $vt->{'q_ave_'.$tid.'_ya_date'} = $vt->q_ave_ya_date;
            $vt->{'q_ave_'.$tid.'_ya'} = $vt->q_ave_ya;
            $vt->{'pvr_'.$tid} = $vt->pvr;
            $vt->{'pvr_'.$tid.'_ya_date'} = $vt->pvr_ya_date;
            $vt->{'pvr_'.$tid.'_ya'} = $vt->pvr_ya;
            $vt->{'voiding_time_'.$tid} = $vt->voiding_time;
            $vt->{'voiding_time_'.$tid.'_ya_date'} = $vt->voiding_time_ya_date;
            $vt->{'voiding_time_'.$tid.'_ya'} = $vt->voiding_time_ya;
            $vt->{'bentuk_kurva_uroflowmetri_'.$tid} = $vt->bentuk_kurva_uroflowmetri;

            $default_by_id[$vt->id] = $vt;
        }
        //dd($default_by_id);

        $max_tab = 5;
        if (count($default_by_id) < $max_tab) {
            $temp_id = 1000 * 1000;
            for($i = count($default_by_id) + 1; $i<= 5; $i++){
                $temp_id++;
                $default_by_id[$temp_id] = [];
            }
        }
        //dd($default_by_id);

        $page_title = 'Penunjang - Uroflowmetri';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'follow_up_v2.update_'.str_replace('detail_', '', $view),
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );

        if (!$active_tab) $active_tab = $first_id;

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                //'default' => $default,
                'default_by_id' => $default_by_id,
                'page_title' => $page_title,
                'form_action' => $form_action,
                'active_tab' => $active_tab,
                'pasien_id' => $id,
            ]
        );
    }

    public function update_oab_penunjang_uroflowmetri_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Penunjang - Uroflowmetri';

        $data = $request->all();
        //dd($data);

        foreach($data['hid_id'] as $tid){
            if ($tid > 1000 * 1000) {
                // New
                $has_tgl = $data['tgl_'.$tid.'_date'] ?? null;
                if ($has_tgl) {
                    $max_ke = (int) OAB_penunjang_uroflowmetri::where('pasien_id', $id)->orderBy('ke', 'desc')->value('ke');
                    $max_ke++;

                    // Insert
                    $data2 = [];
                    $data2['pasien_id'] = $id;
                    $data2['follow_up_id'] = $follow_up_id;
                    $data2['ke'] = $max_ke;
                    $data2['tgl_date'] = $data['tgl_'.$tid.'_date'] ?? null;
                    $data2['voided_volume'] = $data['voided_volume_'.$tid] ?? '';
                    $data2['voided_volume_ya_date'] = $data['voided_volume_'.$tid.'_ya_date'] ?? null;
                    $data2['voided_volume_ya'] = $data['voided_volume_'.$tid.'_ya'] ?? '';
                    $data2['q_max'] = $data['q_max_'.$tid] ?? '';
                    $data2['q_max_ya_date'] = $data['q_max_'.$tid.'_ya_date'] ?? null;
                    $data2['q_max_ya'] = $data['q_max_'.$tid.'_ya'] ?? '';
                    $data2['q_ave'] = $data['q_ave_'.$tid] ?? '';
                    $data2['q_ave_ya_date'] = $data['q_ave_'.$tid.'_ya_date'] ?? null;
                    $data2['q_ave_ya'] = $data['q_ave_'.$tid.'_ya'] ?? '';
                    $data2['pvr'] = $data['pvr_'.$tid] ?? '';
                    $data2['pvr_ya_date'] = $data['pvr_'.$tid.'_ya_date'] ?? null;
                    $data2['pvr_ya'] = $data['pvr_'.$tid.'_ya'] ?? '';
                    $data2['voiding_time'] = $data['voiding_time_'.$tid] ?? '';
                    $data2['voiding_time_ya_date'] = $data['voiding_time_'.$tid.'_ya_date'] ?? null;
                    $data2['voiding_time_ya'] = $data['voiding_time_'.$tid.'_ya'] ?? '';
                    $data2['bentuk_kurva_uroflowmetri'] = $data['bentuk_kurva_uroflowmetri_'.$tid] ?? '';

                    OAB_penunjang_uroflowmetri::base_insert($data2);
                }
            } else {
                // Existing
                $a = [
                    'voided_volume',
                    'q_max',
                    'q_ave',
                    'pvr',
                    'voiding_time',
                ];
                foreach($a as $v){
                    // voided_volume_2
                    // voided_volume_2_ya
                    if (isset($data[$v]) && $data[$v] != 'Ya') {
                        $data[$v.'_'.$tid.'_ya_date'] = null;
                        $data[$v.'_'.$tid.'_ya'] = '';
                    }
                }

                $data2 = [];
                $data2['tgl_date'] = $data['tgl_'.$tid.'_date'] ?? null;
                $data2['voided_volume'] = $data['voided_volume_'.$tid] ?? '';
                $data2['voided_volume_ya_date'] = $data['voided_volume_'.$tid.'_ya_date'] ?? null;
                $data2['voided_volume_ya'] = $data['voided_volume_'.$tid.'_ya'] ?? '';
                $data2['q_max'] = $data['q_max_'.$tid] ?? '';
                $data2['q_max_ya_date'] = $data['q_max_'.$tid.'_ya_date'] ?? null;
                $data2['q_max_ya'] = $data['q_max_'.$tid.'_ya'] ?? '';
                $data2['q_ave'] = $data['q_ave_'.$tid] ?? '';
                $data2['q_ave_ya_date'] = $data['q_ave_'.$tid.'_ya_date'] ?? null;
                $data2['q_ave_ya'] = $data['q_ave_'.$tid.'_ya'] ?? '';
                $data2['pvr'] = $data['pvr_'.$tid] ?? '';
                $data2['pvr_ya_date'] = $data['pvr_'.$tid.'_ya_date'] ?? null;
                $data2['pvr_ya'] = $data['pvr_'.$tid.'_ya'] ?? '';
                $data2['voiding_time'] = $data['voiding_time_'.$tid] ?? '';
                $data2['voiding_time_ya_date'] = $data['voiding_time_'.$tid.'_ya_date'] ?? null;
                $data2['voiding_time_ya'] = $data['voiding_time_'.$tid.'_ya'] ?? '';
                $data2['bentuk_kurva_uroflowmetri'] = $data['bentuk_kurva_uroflowmetri_'.$tid] ?? '';

                OAB_penunjang_uroflowmetri::base_update($data2, "id = $tid AND follow_up_id = $follow_up_id");
            }
        }

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_penunjang_uroflowmetri',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }
}
