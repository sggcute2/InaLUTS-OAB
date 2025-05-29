<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_terapi_operatif;
use App\Modules\Follow_up_v2\Models\OAB\OAB_terapi_operatif_injeksi_botox;
use BS;
use DT;
use FORMAT;

trait OAB_terapi_operatifTrait {
    public function __list_oab_terapi_operatif($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Terapi Operatif';
        $view = $this->_get_method(__METHOD__);
        $add_action = route(
            'follow_up_v2.add_'.str_replace('list_', '', $view),
            $id
        );

        $data_injeksi_botox = OAB_terapi_operatif_injeksi_botox::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->orderBy('injeksi_botox_date', 'desc')
            ->get();

        $column = array();
        $column[] = array('Tanggal', function($row){
            return FORMAT::date($row['injeksi_botox_date']);
        });
        $column[] = array('Dosis', 'injeksi_botox_dosis');
        $column[] = array('Jumlah titik injeksi botox', 'injeksi_botox_jumlah_titik');
        $column[] = array('Action', function($row) {
            return
                BS::button(
                    'Detail',
                    route(MODULE.'.detail_oab_terapi_operatif_injeksi_botox', $row['id']),
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

    private function _form_oab_terapi_operatif_injeksi_botox(
        $id = 0, $follow_up_id, $default = [], $mode = ''
    ): View
    {
        $view = 'form_terapi_operatif_injeksi_botox';
        $page_title  = ($mode == 'detail') ? '' : 'Add ';
        $page_title .= 'Terapi Operatif - Injeksi Botox';
        if ($mode == 'detail') {
            $form_action = route(
                'follow_up_v2.'.str_replace('form_', 'update_oab_', $view),
                ['id' => $id, 'follow_up_id' => $follow_up_id]
            );
        } else {
            // $id = m_pasien.id
            $form_action = route(
                'follow_up_v2.'.str_replace('form_', 'add_oab_', $view),
                ['id' => $id, 'follow_up_id' => $follow_up_id]
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

    public function add_oab_terapi_operatif_injeksi_botox($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        $default = [];

        return $this->_form_oab_terapi_operatif_injeksi_botox($id, $follow_up_id, $default, 'add');
    }

    public function detail_oab_terapi_operatif_injeksi_botox($id, $follow_up_id): View
    {
        $temp = OAB_terapi_operatif_injeksi_botox::findOrFail($id);
        $pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );

        $default = $temp;

        return $this->_form_oab_terapi_operatif_injeksi_botox($id, $follow_up_id, $default, 'detail');
    }

    public function add_oab_terapi_operatif_injeksi_botox_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Terapi Operatif - Injeksi Botox';

        $data = $request->all();
        $data['pasien_id'] = $id;
        $data['follow_up_id'] = $follow_up_id;

        OAB_terapi_operatif_injeksi_botox::base_insert($data);

        $this->flash_success_add($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_terapi_operatif',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }

    public function update_oab_terapi_operatif_injeksi_botox_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $temp = OAB_terapi_operatif_injeksi_botox::findOrFail($id);
        $pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );

        $page_title = 'Terapi Operatif - Injeksi Botox';

        $data = $request->all();

        OAB_terapi_operatif_injeksi_botox::base_update_by_id(
            $data, $id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_terapi_operatif',
            ['id' => $pasien->id, 'follow_up_id' => $follow_up_id]
        );
    }

    public function detail_oab_terapi_operatif($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        if (!OAB_terapi_operatif::where('pasien_id', $id)->where('follow_up_id', $follow_up_id)->exists()) {
            OAB_terapi_operatif::base_insert(['pasien_id' => $id, 'follow_up_id' => $follow_up_id]);
        }
        $default = OAB_terapi_operatif::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->first();
        $page_title = 'Terapi Operatif';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'follow_up_v2.update_'.str_replace('detail_', '', $view),
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );

        $data = OAB_terapi_operatif_injeksi_botox::where('pasien_id', $id)
            ->where('follow_up_id', $follow_up_id)
            ->orderBy('injeksi_botox_date', 'desc')
            ->get();
        $column = array();
        $column[] = array('Tanggal', function($row){
            return FORMAT::date($row['injeksi_botox_date']);
        });
        $column[] = array('Dosis', 'injeksi_botox_dosis');
        $column[] = array('Jumlah titik injeksi botox', 'injeksi_botox_jumlah_titik');
        $column[] = array('Action', function($row) {
            return
                BS::button(
                    'Detail',
                    route(MODULE.'.detail_oab_terapi_operatif_injeksi_botox',
                        ['id' => $row['id'], 'follow_up_id' => $row['follow_up_id']]
                    ),
                    false
                );
        });
        DT::add('injeksi_botox', $data, $column);
        $add_action = route(
            'follow_up_v2.add_'.str_replace('detail_', '', $view).'_injeksi_botox',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );

        return $this->moduleView(
            'OAB/form_'.str_replace('detail_oab_', '', $view),
            [
                'default' => $default,
                'page_title' => $page_title,
                'form_action' => $form_action,
                'add_action' => $add_action,
            ]
        );
    }

    public function update_oab_terapi_operatif_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Terapi Operatif';

        $data = $request->all();
        $a = [
            'sns',
            'augmentasi_cystoplasty',
        ];
        foreach($a as $va){
            if (isset($data[$va]) && $data[$va] != 'Ya') {
                $data[$va.'_ya_date'] = null;
            }
        }
        OAB_terapi_operatif::base_update_by_pasien_id_and_follow_up_id(
            $data, $id, $follow_up_id
        );

        $this->flash_success_update($page_title);

        return redirect()->route(
            MODULE.'.detail_oab_terapi_operatif',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }
}
