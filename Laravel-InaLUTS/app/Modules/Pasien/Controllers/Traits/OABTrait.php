<?php

namespace App\Modules\Pasien\Controllers\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_anamnesis;
use App\Modules\Pasien\Models\OAB\OAB_keluhan_tambahan;
use App\Modules\Pasien\Models\OAB\OAB_faktor_resiko;

trait OABTrait {
    public function detail_oab_anamnesis($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_anamnesis::where('pasien_id', $id)->exists()) {
            OAB_anamnesis::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_anamnesis::where('pasien_id', $id)->first();
        $page_title = 'Anamnesis';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'pasien.update_'.str_replace('detail_', '', $view),
            $id
        );

        return $this->moduleView('OAB/form_'.str_replace('detail_oab_', '', $view), [
            'default' => $default,
            'page_title' => $page_title,
            'form_action' => $form_action,
        ]);
    }

    public function update_oab_anamnesis_process(Request $request, $id): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Anamnesis';

        OAB_anamnesis::base_update_by_pasien_id($request->all(), $id);

        $this->flash_success_update($page_title);

        return redirect()->route(MODULE.'.detail_oab_anamnesis', $id);
    }

    public function detail_oab_keluhan_tambahan($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_keluhan_tambahan::where('pasien_id', $id)->exists()) {
            OAB_keluhan_tambahan::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_keluhan_tambahan::where('pasien_id', $id)->first();
        $page_title = 'Keluhan Tambahan';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'pasien.update_'.str_replace('detail_', '', $view),
            $id
        );

        return $this->moduleView('OAB/form_'.str_replace('detail_oab_', '', $view), [
            'default' => $default,
            'page_title' => $page_title,
            'form_action' => $form_action,
        ]);
    }

    public function update_oab_keluhan_tambahan_process(Request $request, $id): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Keluhan Tambahan';

        OAB_keluhan_tambahan::base_update_by_pasien_id($request->all(), $id);

        $this->flash_success_update($page_title);

        return redirect()->route(MODULE.'.detail_oab_keluhan_tambahan', $id);
    }

    public function detail_oab_faktor_resiko($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_faktor_resiko::where('pasien_id', $id)->exists()) {
            OAB_faktor_resiko::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_faktor_resiko::where('pasien_id', $id)->first();
        $page_title = 'Faktor Resiko dan Penyakit Penyerta';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'pasien.update_'.str_replace('detail_', '', $view),
            $id
        );

        return $this->moduleView('OAB/form_'.str_replace('detail_oab_', '', $view), [
            'default' => $default,
            'page_title' => $page_title,
            'form_action' => $form_action,
        ]);
    }

    public function update_oab_faktor_resiko_process(Request $request, $id): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Faktor Resiko dan Penyakit Penyerta';

        $data = $request->all();
        if ($data['gangguan_mood'] == 'Ya') {
            if ($data['gangguan_mood_ya'] != 'Gangguan Mood') {
                $data['gangguan_mood_ya2'] = '';
            }
        } else {
            $data['gangguan_mood_ya'] = '';
        }
        if ($data['diabetes'] != 'Ya') {
            $data['diabetes_ya'] = '';
        }
        if ($data['menopause'] != 'Ya') {
            $data['menopause_ya'] = '';
        }
        if ($data['kanker_ginekologi'] != 'Ya') {
            $data['kanker_ginekologi_ya'] = '';
        }
        if ($data['spinal_cord_injury'] != 'Ya') {
            $data['trauma_tulang_belakang'] = '';
            $data['tumor_tulang_belakang'] = '';
            $data['myelitis'] = '';
            $data['spondilitis_tb'] = '';
        }
        OAB_faktor_resiko::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(MODULE.'.detail_oab_faktor_resiko', $id);
    }
}
