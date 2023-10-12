<?php

namespace App\Modules\Follow_up\Controllers\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up\Models\Follow_up;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_detail;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_pemeriksaan_laboratorium;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_terapi_operatif_injeksi_botox;
/*
use App\Modules\Follow_up\Controllers\Traits\OAB\{
    OAB_terapi_operatifTrait,
};
*/
use BS;
use DT;
use FORMAT;

trait OABTrait {

    //use OAB_terapi_operatifTrait;

    public function detail_oab($pasien_id, $id): View
    {
        //echo '$pasien_id = '.$pasien_id.' , $id = '.$id;exit;

        $follow_up = Follow_up::find($id);
        //dd($follow_up);

        if (!OAB_follow_up_detail::where('pasien_id', $pasien_id)
            ->where('follow_up_id', $id)
            ->exists()
        ) {
            OAB_follow_up_detail::base_insert([
                'pasien_id' => $pasien_id,
                'follow_up_id' => $id,
            ]);
        }
        $default = OAB_follow_up_detail::where('pasien_id', $pasien_id)
            ->where('follow_up_id', $id)
            ->first();
        $page_title = 'Follow Up , Tanggal : '
            .FORMAT::date($follow_up->pemeriksaan_date);
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'follow_up.update_'.str_replace('detail_', '', $view),
            [
                'pasien_id' => $pasien_id,
                'id' => $id,
            ]
        );
        //dd($form_action);

        $ns = 'oabss_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }

        $ns = 'qol_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);

        $ns = 'bladder_diary_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);

        //===[ Begin Process : Pemeriksaan Penunjang ]==========================

        //===[ Begin Process : Pemeriksaan Penunjang : USG ]====================
        $ns = 'pemeriksaan_penunjang_usg_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Pemeriksaan Penunjang : USG ]======================

        //===[ Begin Process : Pemeriksaan Penunjang : Uroflowmetri ]===========
        $ns = 'pemeriksaan_penunjang_uroflowmetri_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Pemeriksaan Penunjang : Uroflowmetri ]=============

        //===[ Begin Process : Pemeriksaan Penunjang : Bladder Diary ]==========
        $ns = 'pemeriksaan_penunjang_bladder_diary_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Pemeriksaan Penunjang : Bladder Diary ]============

        //===[ Begin Process : Pemeriksaan Penunjang : UPP ]====================
        $ns = 'pemeriksaan_penunjang_upp_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Pemeriksaan Penunjang : UPP ]======================

        //===[ Begin Process : Pemeriksaan Penunjang : Urodinamik ]=============
        $ns = 'pemeriksaan_penunjang_urodinamik_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Pemeriksaan Penunjang : Urodinamik ]===============

        //===[ Begin Process : Pemeriksaan Penunjang : Sistoskopi ]=============
        $ns = 'pemeriksaan_penunjang_sistoskopi_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Pemeriksaan Penunjang : Sistoskopi ]===============

        $data = OAB_follow_up_pemeriksaan_laboratorium::where('pasien_id', $pasien_id)
            ->where('follow_up_id', $id)
            ->orderBy('lab_date', 'desc')
            ->get();

        $column = array();
        $column[] = array('Tanggal Pemeriksaan Laboratorium', function($row){
            return FORMAT::date($row['lab_date']);
        });
        $column[] = array('Action', function($row) {
            return
                BS::button(
                    'Detail',
                    route(MODULE.'.detail_oab_pemeriksaan_laboratorium', [
                        'pasien_id' => $row['pasien_id'],
                        'id' => $row['id'],
                    ]),
                    false
                );
        });
        DT::add('pemeriksaan_penunjang__pemeriksaan_laboratorium', $data, $column);
        //===[ End Process : Pemeriksaan Penunjang ]============================

        //===[ Begin Process : Terapi Lanjutan ]================================

        //===[ Begin Process : Terapi Lanjutan : Modifikasi Gaya Hidup ]========
        $ns = 'terapi_modifikasi_gaya_hidup_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Terapi Lanjutan : Modifikasi Gaya Hidup ]==========

        //===[ Begin Process : Terapi Lanjutan : Non-Operatif ]=================
        $ns = 'terapi_non_operatif_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Terapi Lanjutan : Non-Operatif ]===================

        //===[ Begin Process : Terapi Lanjutan : Medikamentosa ]================
        $ns = 'terapi_medikamentosa_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Terapi Lanjutan : Medikamentosa ]==================

        //===[ Begin Process : Terapi Lanjutan : Rehabilitasi ]=================
        $ns = 'terapi_rehabilitasi_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);
        //===[ End Process : Terapi Lanjutan : Rehabilitasi ]===================

        //===[ Begin Process : Terapi Lanjutan : Operatif ]=====================
        $ns = 'terapi_operatif_';$field = $ns.'ya';
        try {
            $data_arr = unserialize($default[$field]);
        } catch (Exception $exception) {
            $data_arr = [];
        }
        if (count($data_arr) > 0) {
            foreach($data_arr as $f => $v)$default[$f] = $v;
        }
        //dd($default);

        $data = OAB_follow_up_terapi_operatif_injeksi_botox::where('pasien_id', $pasien_id)
            ->where('follow_up_id', $id)
            ->orderBy('injeksi_botox_date', 'desc')
            ->get();
        $column = array();
        $column[] = array('Tanggal', function($row){
            return FORMAT::date($row['injeksi_botox_date']);
        });
        $column[] = array('Tindakan', 'injeksi_botox_tindakan');
        $column[] = array('Action', function($row) {
            return
                BS::button(
                    'Detail',
                    route(MODULE.'.detail_oab_terapi_operatif_injeksi_botox', [
                        'pasien_id' => $row['pasien_id'],
                        'id' => $row['id'],
                    ]),
                    false
                );
        });
        DT::add('terapi__operatif__injeksi_botox', $data, $column);
        //===[ End Process : Terapi Lanjutan : Operatif ]=======================

        //===[ End Process : Terapi Lanjutan ]==================================

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                'default' => $default,
                'page_title' => $page_title,
                'form_action' => $form_action,
                'pasien_id' => $pasien_id,
                'id' => $id,
            ]
        );
    }

    public function update_oab_process(
        Request $request, $pasien_id, $id
    ): RedirectResponse
    {
        $follow_up = Follow_up::find($id);

        $page_title = 'Follow Up , Tanggal : '
            .FORMAT::date($follow_up->pemeriksaan_date);

        $data = $request->all();

        // Begin Process : OABSS
        $field = 'oabss';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        // End Process : OABSS

        // Begin Process : QOL
        $field = 'qol';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        // End Process : QOL

        // Begin Process : Bladder Diary
        $field = 'bladder_diary';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
            //$data[$field] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        // End Process : Bladder Diary

        //===[ Begin Process : Pemeriksaan Penunjang ]==========================

        //===[ Begin Process : Pemeriksaan Penunjang : USG ]====================
        $field = 'pemeriksaan_penunjang_usg';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Pemeriksaan Penunjang : USG ]======================

        //===[ Begin Process : Pemeriksaan Penunjang : Uroflowmetri ]===========
        $field = 'pemeriksaan_penunjang_uroflowmetri';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Pemeriksaan Penunjang : Uroflowmetri ]=============

        //=[ Begin Process : Pemeriksaan Penunjang : Pemeriksaan Laboratorium ]=
        $field = 'pemeriksaan_penunjang_pemeriksaan_laboratorium';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Pemeriksaan Penunjang : Pemeriksaan Laboratorium ]=

        //===[ Begin Process : Pemeriksaan Penunjang : Bladder Diary ]==========
        $field = 'pemeriksaan_penunjang_bladder_diary';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Pemeriksaan Penunjang : Bladder Diary ]============

        //===[ Begin Process : Pemeriksaan Penunjang : UPP ]====================
        $field = 'pemeriksaan_penunjang_upp';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Pemeriksaan Penunjang : UPP ]======================

        //===[ Begin Process : Pemeriksaan Penunjang : Urodinamik ]=============
        $field = 'pemeriksaan_penunjang_urodinamik';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Pemeriksaan Penunjang : Urodinamik ]===============

        //===[ Begin Process : Pemeriksaan Penunjang : Sistoskopi ]=============
        $field = 'pemeriksaan_penunjang_sistoskopi';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Pemeriksaan Penunjang : Sistoskopi ]===============

        //===[ End Process : Pemeriksaan Penunjang ]============================

        //===[ Begin Process : Terapi Lanjutan ]================================

        //===[ Begin Process : Terapi Lanjutan : Modifikasi Gaya Hidup ]========
        $field = 'terapi_modifikasi_gaya_hidup';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Terapi Lanjutan : Modifikasi Gaya Hidup ]==========

        //===[ Begin Process : Terapi Lanjutan : Non-Operatif ]=================
        $field = 'terapi_non_operatif';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Terapi Lanjutan : Non-Operatif ]===================

        //===[ Begin Process : Terapi Lanjutan : Medikamentosa ]================
        $field = 'terapi_medikamentosa';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Terapi Lanjutan : Medikamentosa ]==================

        //===[ Begin Process : Terapi Lanjutan : Rehabilitasi ]=================
        $field = 'terapi_rehabilitasi';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Terapi Lanjutan : Rehabilitasi ]===================

        //===[ Begin Process : Terapi Lanjutan : Operatif ]=====================
        $field = 'terapi_operatif';
        if (isset($data[$field]) && $data[$field] == 'Ya') {
            $data_temp = [];
            $ns = $field.'_';
            foreach($data as $f => $v){
                if (substr($f, 0, strlen($ns)) == $ns) {
                    $data_temp[$f] = $v;
                }
            }
            $data[$field.'_ya'] = serialize($data_temp);
        } else {
            $data[$field.'_ya'] = serialize([]);
        }
        //===[ End Process : Terapi Lanjutan : Operatif ]=======================

        //===[ End Process : Terapi Lanjutan ]==================================

        //dd($data);

        OAB_follow_up_detail::base_update($data, "
            pasien_id = $pasien_id AND follow_up_id = $id
        ");

        if (
            request()->get('forward_to')
                == 'pemeriksaan_penunjang_pemeriksaan_laboratorium'
        ) {
            return redirect()->route(
                MODULE.'.add_oab_pemeriksaan_laboratorium', [
                    'pasien_id' => $pasien_id,
                    'id' => $id,
                ]
            );
        } else if (
            request()->get('forward_to')
                == 'terapi_operatif_injeksi_botox'
        ) {
            return redirect()->route(
                MODULE.'.add_oab_terapi_operatif_injeksi_botox', [
                    'pasien_id' => $pasien_id,
                    'id' => $id,
                ]
            );
        } else {
            $this->flash_success_update($page_title);

            return redirect()->route(MODULE.'.detail', [
                'pasien_id' => $pasien_id,
                'id' => $id,
            ]);
        }
    }
}
