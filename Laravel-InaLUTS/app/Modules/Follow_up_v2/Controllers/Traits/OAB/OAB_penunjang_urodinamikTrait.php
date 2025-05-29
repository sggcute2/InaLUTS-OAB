<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_penunjang_urodinamik;
use BS;
use DT;
use FORMAT;

trait OAB_penunjang_urodinamikTrait {
    public function detail_oab_penunjang_urodinamik($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_penunjang_urodinamik::where('pasien_id', $id)->where('follow_up_id', $follow_up_id)->exists()) {
            OAB_penunjang_urodinamik::base_insert(['pasien_id' => $id, 'follow_up_id' => $follow_up_id]);
        }
        $default = OAB_penunjang_urodinamik::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->first();
        //dd($default);

        $active_tab = 0;
        $first_id = 0;
        $temp = OAB_penunjang_urodinamik::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->orderBy('id', 'ASC')
            ->get();
        $default_by_id = [];
        foreach($temp as $vt){
            $tid = $vt->id;
            if (!$first_id) {
                $first_id = $vt->id;
                //$vt->{'pemeriksaan_urodinamik'} = $vt->pemeriksaan_urodinamik;
            }

            $vt->{'tgl_'.$tid.'_date'} = $vt->tgl_date;
            //$vt->{'pemeriksaan_urodinamik_'.$tid} = $vt->pemeriksaan_urodinamik;
            //$vt->{'pemeriksaan_urodinamik_'.$tid.'_ya_date'} = $vt->pemeriksaan_urodinamik_ya_date;
            $vt->{'kapasitas_kandung_kemih_'.$tid.'_1'} = $vt->kapasitas_kandung_kemih_1;
            $vt->{'kapasitas_kandung_kemih_'.$tid.'_2'} = $vt->kapasitas_kandung_kemih_2;
            $vt->{'compliance_'.$tid} = $vt->compliance;
            $vt->{'detrusor_overactivity_'.$tid} = $vt->detrusor_overactivity;
            $vt->{'detrusor_overactivity_incontinence_'.$tid} = $vt->detrusor_overactivity_incontinence;
            $vt->{'urodynamic_stress_urinary_incontinence_'.$tid} = $vt->urodynamic_stress_urinary_incontinence;
            $vt->{'obstruksi_infravesical_'.$tid} = $vt->obstruksi_infravesical;
            $vt->{'detrusor_underactivity_'.$tid} = $vt->detrusor_underactivity;
            $vt->{'dysfunctional_voiding_'.$tid} = $vt->dysfunctional_voiding;
            $vt->{'dsd_'.$tid} = $vt->dsd;
            $vt->{'neurogenic_bladder_'.$tid} = $vt->neurogenic_bladder;
            $vt->{'detrusor_sphincter_dyssynergia_'.$tid} = $vt->detrusor_sphincter_dyssynergia;
            $vt->{'pvr_'.$tid.'_1'} = $vt->pvr_1;
            $vt->{'pvr_'.$tid.'_2'} = $vt->pvr_2;

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

        $page_title = 'Penunjang - urodinamik';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'follow_up_v2.update_'.str_replace('detail_', '', $view),
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );

        if (!$active_tab) $active_tab = $first_id;

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                'default' => $default,
                'default_by_id' => $default_by_id,
                'page_title' => $page_title,
                'form_action' => $form_action,
                'active_tab' => $active_tab,
                'pasien_id' => $id,
            ]
        );
    }

    public function update_oab_penunjang_urodinamik_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Penunjang - urodinamik';

        $data = $request->all();
        //dd($data);

        OAB_penunjang_urodinamik::base_update([
            'pemeriksaan_urodinamik' => $data['pemeriksaan_urodinamik'] ?? ''
        ], "pasien_id = $id");

        foreach($data['hid_id'] as $tid){
            if ($tid > 1000 * 1000) {
                // New
                $has_tgl = $data['tgl_'.$tid.'_date'] ?? null;
                if ($has_tgl) {
                    $max_ke = (int) OAB_penunjang_urodinamik::where('pasien_id', $id)->orderBy('ke', 'desc')->value('ke');
                    $max_ke++;

                    // Insert
                    $data2 = [];
                    $data2['pasien_id'] = $id;
                    $data2['follow_up_id'] = $follow_up_id;
                    $data2['ke'] = $max_ke;
                    $data2['tgl_date'] = $data['tgl_'.$tid.'_date'] ?? null;
                    if ($max_ke == 1) {
                        //$data2['pemeriksaan_urodinamik'] = $data['pemeriksaan_urodinamik_'.$tid] ?? '';
                        //$data2['pemeriksaan_urodinamik_ya_date'] = $data['pemeriksaan_urodinamik_'.$tid.'_ya_date'] ?? null;
                    }
                    $data2['kapasitas_kandung_kemih_1'] = $data['kapasitas_kandung_kemih_'.$tid.'_1'] ?? '';
                    $data2['kapasitas_kandung_kemih_2'] = $data['kapasitas_kandung_kemih_'.$tid.'_2'] ?? '';
                    $data2['compliance'] = $data['compliance_'.$tid] ?? '';
                    $data2['detrusor_overactivity'] = $data['detrusor_overactivity_'.$tid] ?? '';
                    $data2['detrusor_overactivity_incontinence'] = $data['detrusor_overactivity_incontinence_'.$tid] ?? '';
                    $data2['urodynamic_stress_urinary_incontinence'] = $data['urodynamic_stress_urinary_incontinence_'.$tid] ?? '';
                    $data2['obstruksi_infravesical'] = $data['obstruksi_infravesical_'.$tid] ?? '';
                    $data2['detrusor_underactivity'] = $data['detrusor_underactivity_'.$tid] ?? '';
                    $data2['dysfunctional_voiding'] = $data['dysfunctional_voiding_'.$tid] ?? '';
                    $data2['dsd'] = $data['dsd_'.$tid] ?? '';
                    $data2['neurogenic_bladder'] = $data['neurogenic_bladder_'.$tid] ?? '';
                    $data2['detrusor_sphincter_dyssynergia'] = $data['detrusor_sphincter_dyssynergia_'.$tid] ?? '';
                    $data2['pvr_1'] = $data['pvr_'.$tid.'_1'] ?? '';
                    $data2['pvr_2'] = $data['pvr_'.$tid.'_2'] ?? '';

                    OAB_penunjang_urodinamik::base_insert($data2);
                }
            } else {
                // Existing
                $data2 = [];
                $data2['tgl_date'] = $data['tgl_'.$tid.'_date'] ?? null;
                //$data2['pemeriksaan_urodinamik'] = $data['pemeriksaan_urodinamik_'.$tid] ?? '';
                //$data2['pemeriksaan_urodinamik_ya_date'] = $data['pemeriksaan_urodinamik_'.$tid.'_ya_date'] ?? null;
                $data2['kapasitas_kandung_kemih_1'] = $data['kapasitas_kandung_kemih_'.$tid.'_1'] ?? '';
                $data2['kapasitas_kandung_kemih_2'] = $data['kapasitas_kandung_kemih_'.$tid.'_2'] ?? '';
                $data2['compliance'] = $data['compliance_'.$tid] ?? '';
                $data2['detrusor_overactivity'] = $data['detrusor_overactivity_'.$tid] ?? '';
                $data2['detrusor_overactivity_incontinence'] = $data['detrusor_overactivity_incontinence_'.$tid] ?? '';
                $data2['urodynamic_stress_urinary_incontinence'] = $data['urodynamic_stress_urinary_incontinence_'.$tid] ?? '';
                $data2['obstruksi_infravesical'] = $data['obstruksi_infravesical_'.$tid] ?? '';
                $data2['detrusor_underactivity'] = $data['detrusor_underactivity_'.$tid] ?? '';
                $data2['dysfunctional_voiding'] = $data['dysfunctional_voiding_'.$tid] ?? '';
                $data2['dsd'] = $data['dsd_'.$tid] ?? '';
                $data2['neurogenic_bladder'] = $data['neurogenic_bladder_'.$tid] ?? '';
                $data2['detrusor_sphincter_dyssynergia'] = $data['detrusor_sphincter_dyssynergia_'.$tid] ?? '';
                $data2['pvr_1'] = $data['pvr_'.$tid.'_1'] ?? '';
                $data2['pvr_2'] = $data['pvr_'.$tid.'_2'] ?? '';

                OAB_penunjang_urodinamik::base_update($data2, "id = $tid AND follow_up_id = $follow_up_id");
            }
        }

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_penunjang_urodinamik',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }
}
