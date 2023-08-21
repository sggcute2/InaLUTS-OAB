<?php

namespace App\Modules\Pasien\Controllers\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Models\OAB\OAB_anamnesis;
use App\Modules\Pasien\Models\OAB\OAB_keluhan_tambahan;
use App\Modules\Pasien\Models\OAB\OAB_faktor_resiko;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_pengobatan_1_bln;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_pengobatan_luts;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_operasi_urologi;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_operasi_non_urologi;
use App\Modules\Pasien\Models\OAB\OAB_riwayat_radiasi;
use App\Modules\Pasien\Models\OAB\OAB_sistem_skor;
use App\Modules\Pasien\Models\OAB\OAB_kuesioner_oabss;
use App\Modules\Pasien\Models\OAB\OAB_pemeriksaan_fisik;
use App\Modules\Pasien\Models\OAB\OAB_pemeriksaan_laboratorium;
use App\Modules\Pasien\Models\OAB\OAB_penunjang_uroflowmetri;
use App\Modules\Pasien\Models\OAB\OAB_penunjang_urodinamik;
use App\Modules\Pasien\Models\OAB\OAB_pemeriksaan_imaging;
use App\Modules\Pasien\Models\OAB\OAB_penunjang;
use BS;
use DT;
use FORMAT;

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

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                'default' => $default,
                'page_title' => $page_title,
                'form_action' => $form_action,
            ]
        );
    }

    public function update_oab_anamnesis_process(
        Request $request, $id
    ): RedirectResponse
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

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                'default' => $default,
                'page_title' => $page_title,
                'form_action' => $form_action,
            ]
        );
    }

    public function update_oab_keluhan_tambahan_process(
        Request $request, $id
    ): RedirectResponse
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

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                'default' => $default,
                'page_title' => $page_title,
                'form_action' => $form_action,
            ]
        );
    }

    public function update_oab_faktor_resiko_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Faktor Resiko dan Penyakit Penyerta';

        $data = $request->all();
        if (isset($data['gangguan_mood']) && $data['gangguan_mood'] == 'Ya') {
            if (
                isset($data['gangguan_mood_ya'])
                && $data['gangguan_mood_ya'] != 'Gangguan Mood'
            ) {
                $data['gangguan_mood_ya2'] = '';
            }
        } else {
            $data['gangguan_mood_ya'] = '';
        }
        if (isset($data['diabetes']) && $data['diabetes'] != 'Ya') {
            $data['diabetes_ya'] = '';
        }
        if (isset($data['menopause']) && $data['menopause'] != 'Ya') {
            $data['menopause_ya'] = '';
        }
        if (
            isset($data['kanker_ginekologi'])
            && $data['kanker_ginekologi'] != 'Ya'
        ) {
            $data['kanker_ginekologi_ya'] = '';
        }
        if (
            isset($data['spinal_cord_injury'])
            && $data['spinal_cord_injury'] != 'Ya'
        ) {
            $data['trauma_tulang_belakang'] = '';
            $data['tumor_tulang_belakang'] = '';
            $data['myelitis'] = '';
            $data['spondilitis_tb'] = '';
        }
        OAB_faktor_resiko::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(MODULE.'.detail_oab_faktor_resiko', $id);
    }

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

    public function detail_oab_riwayat_operasi_urologi($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_riwayat_operasi_urologi::where('pasien_id', $id)->exists()) {
            OAB_riwayat_operasi_urologi::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_riwayat_operasi_urologi::where('pasien_id', $id)
            ->first();
        $page_title = 'Riwayat operasi / endoskopi urologi';
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

    public function update_oab_riwayat_operasi_urologi_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Riwayat operasi / endoskopi urologi';

        $data = $request->all();
        $a = [
            'tur_prostat',
            'radikal_prostat',
            'rekonstruksi_uretra',
            'tur_buli',
            'operasi_anti_inkontinensia_urine',
            'operasi_pop',
            'injeksi_botox',
            'sistoskopi',
        ];
        foreach($a as $v){
            if ($v == 'operasi_anti_inkontinensia_urine') {
                if (isset($data[$v]) && $data[$v] != 'Ya') {
                    $b = [
                        'sling',
                        'burch_kolposuspensi',
                        'aus',
                        'bulking_agent',
                    ];
                    foreach($b as $vb){
                        $data['c_operasi_anti_inkontinensia_urine_'.$vb] = 0;
                    }
                }
            } else {
                if (isset($data[$v]) && $data[$v] != 'Ya') {
                    $data[$v.'_ya_date'] = null;
                }
            }
        }
        OAB_riwayat_operasi_urologi::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_riwayat_operasi_urologi', $id
        );
    }

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

    public function detail_oab_riwayat_radiasi($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_riwayat_radiasi::where('pasien_id', $id)->exists()) {
            OAB_riwayat_radiasi::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_riwayat_radiasi::where('pasien_id', $id)
            ->first();
        $page_title = 'Riwayat Radiasi dan Kemoterapi';
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

    public function update_oab_riwayat_radiasi_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Riwayat Radiasi dan Kemoterapi';

        $data = $request->all();
        $a = [
            'riwayat_radiasi_pelvis',
            'riwayat_kemoterapi',
        ];
        foreach($a as $v){
            if (isset($data[$v]) && $data[$v] != 'Ya') {
                $b = [
                    'keganasan_saluran_kemih',
                    'keganasan_saluran_cerna',
                    'keganasan_ginekologi',
                ];
                foreach($b as $vb){
                    $data['c_'.$v.'_'.$vb] = 0;
                }
            }
        }
        OAB_riwayat_radiasi::base_update_by_pasien_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_riwayat_radiasi', $id
        );
    }

    public function detail_oab_sistem_skor($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_sistem_skor::where('pasien_id', $id)->exists()) {
            OAB_sistem_skor::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_sistem_skor::where('pasien_id', $id)
            ->first();
        $page_title = 'Sistem skor';
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

    public function update_oab_sistem_skor_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Sistem skor';

        OAB_sistem_skor::base_update_by_pasien_id($request->all(), $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_sistem_skor', $id
        );
    }

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

    public function list_oab_pemeriksaan_laboratorium($id): View
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan Laboratorium';
        $view = $this->_get_method(__METHOD__);
        $add_action = route(
            'pasien.add_'.str_replace('list_', '', $view),
            $id
        );

        $data = OAB_pemeriksaan_laboratorium::where('pasien_id', $id)
            ->orderBy('lab_date', 'desc')
            ->get();

        $column = array();
        $column[] = array('Tanggal '.$page_title, function($row){
            return FORMAT::date($row['lab_date']);
        });
        $column[] = array('Action', function($row) {
            return
                BS::button(
                    'Detail',
                    route(MODULE.'.detail_oab_pemeriksaan_laboratorium', $row['id']),
                    false
                );
        });
        DT::add(false, $data, $column);

        return $this->moduleView(
            'OAB/list_'.str_replace('list_oab_', '', $view),
            [
                'page_title' => $page_title,
                'add_action' => $add_action,
            ]
        );
    }

    private function _form_oab_pemeriksaan_laboratorium(
        $id = 0, $default = [], $mode = ''
    ): View
    {
        $view = 'form_pemeriksaan_laboratorium';
        $page_title  = ($mode == 'detail') ? '' : 'Add ';
        $page_title .= 'Pemeriksaan Laboratorium';
        if ($mode == 'detail') {
            $form_action = route(
                'pasien.'.str_replace('form_', 'update_oab_', $view),
                $id
            );
        } else {
            // $id = m_pasien.id
            $form_action = route(
                'pasien.'.str_replace('form_', 'add_oab_', $view),
                $id
            );
        }

        return $this->moduleView(
            'OAB/'.$view,
            [
                'default' => $default,
                'page_title' => $page_title,
                'form_action' => $form_action,
            ]
        );
    }

    public function add_oab_pemeriksaan_laboratorium($id): View
    {
        $pasien = $this->_allow_access($id);

        $default = [];

        return $this->_form_oab_pemeriksaan_laboratorium($id, $default, 'add');
    }

    public function add_oab_pemeriksaan_laboratorium_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan Laboratorium';

        $data = $request->all();
        $data['pasien_id'] = $id;

        OAB_pemeriksaan_laboratorium::base_insert($data);

        $this->flash_success_add($page_title);

        return redirect()->route(
            MODULE.'.list_oab_pemeriksaan_laboratorium', $id
        );
    }

    public function detail_oab_pemeriksaan_laboratorium($id): View
    {
        $temp = OAB_pemeriksaan_laboratorium::findOrFail($id);
        $pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );

        $default = $temp;

        return $this->_form_oab_pemeriksaan_laboratorium($id, $default, 'detail');
    }

    public function update_oab_pemeriksaan_laboratorium_process(
        Request $request, $id
    ): RedirectResponse
    {
        $temp = OAB_pemeriksaan_laboratorium::findOrFail($id);
        $pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );

        $page_title = 'Pemeriksaan Laboratorium';

        $data = $request->all();

        OAB_pemeriksaan_laboratorium::base_update_by_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.list_oab_pemeriksaan_laboratorium', $pasien->id
        );
    }

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

    public function detail_oab_pemeriksaan_imaging($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_pemeriksaan_imaging::where('pasien_id', $id)->exists()) {
            OAB_pemeriksaan_imaging::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_pemeriksaan_imaging::where('pasien_id', $id)
            ->first();
        $page_title = 'Pemeriksaan Imaging';
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

    public function update_oab_pemeriksaan_imaging_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan Imaging';

        $data = $request->all();
        if (isset($data['usg']) && $data['usg'] != 'Dilakukan') {
            $data['usg_date'] = null;
        }
        OAB_pemeriksaan_imaging::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_pemeriksaan_imaging', $id
        );
    }

    public function detail_oab_penunjang($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_penunjang::where('pasien_id', $id)->exists()) {
            OAB_penunjang::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_penunjang::where('pasien_id', $id)
            ->first();
        $page_title = 'Penunjang';
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

    public function update_oab_penunjang_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Penunjang';

        $data = $request->all();
        if (isset($data['upp']) && $data['upp'] != 'Dikerjakan') {
            $data['maximal_urethral_pressure'] = '';
            $data['functional_urethral_length'] = '';
        }
        if (isset($data['sistoskopi']) && $data['sistoskopi'] != 'Dikerjakan') {
            $data['mukosa_buli'] = '';
            $data['trabekulasi'] = '';
            $data['sakulasi_divertikel'] = '';
            $data['kapasitas_buli'] = '';
            $data['batu'] = '';
            $data['tumor'] = '';
            $data['lobus_medius'] = '';
            $data['kissing_lobe'] = '';
            $data['muara_ureter'] = '';
            $data['urethra'] = '';
            $data['mue'] = '';
            $data['lichen_schlerosis'] = '';
        }
        OAB_penunjang::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_penunjang', $id
        );
    }

    public function detail_oab_kuesioner_oabss($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_kuesioner_oabss::where('pasien_id', $id)->exists()) {
            OAB_kuesioner_oabss::base_insert(['pasien_id' => $id]);
        }
        $default = OAB_kuesioner_oabss::where('pasien_id', $id)
            ->first();
        $page_title = 'Kuesioner OABSS';
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

    public function update_oab_kuesioner_oabss_process(
        Request $request, $id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Kuesioner OABSS';

        $data = $request->all();
        $data['total_score'] =
            ($request->get('score_1', 0))
            + ($request->get('score_2', 0))
            + ($request->get('score_3', 0))
            + ($request->get('score_4', 0));
        OAB_kuesioner_oabss::base_update_by_pasien_id($data, $id);

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_kuesioner_oabss', $id
        );
    }
}
