<?php

namespace App\Modules\Follow_up_v2\Controllers\Traits\OAB;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Follow_up_v2\Models\OAB\OAB_pemeriksaan_laboratorium;
use BS;
use DT;
use FORMAT;

trait OAB_pemeriksaan_laboratoriumTrait {

    public function list_oab_pemeriksaan_laboratorium($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan Laboratorium';
        $view = $this->_get_method(__METHOD__);
        $add_action = route(
            'follow_up_v2.add_'.str_replace('list_', '', $view),
            ['id' => $id, 'follow_up_id' => $follow_up_id]
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
                    route(MODULE.'.detail_oab_pemeriksaan_laboratorium',
                        ['id' => $row['id'], 'follow_up_id' => $row['follow_up_id']]
                    ),
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
        $id = 0, $follow_up_id = 0, $default = [], $mode = ''
    ): View
    {
        $view = 'form_pemeriksaan_laboratorium';
        $page_title  = ($mode == 'detail') ? '' : 'Add ';
        $page_title .= 'Pemeriksaan Laboratorium';
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

    public function add_oab_pemeriksaan_laboratorium($id, $follow_up_id): View
    {
        $pasien = $this->_allow_access($id);

        $default = [];

        return $this->_form_oab_pemeriksaan_laboratorium($id, $follow_up_id, $default, 'add');
    }

    public function add_oab_pemeriksaan_laboratorium_process(
        Request $request, $id, $follow_up_id
    ): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan Laboratorium';

        $data = $request->all();
        $data['pasien_id'] = $id;
        $data['follow_up_id'] = $follow_up_id;

        OAB_pemeriksaan_laboratorium::base_insert($data);

        $this->flash_success_add($page_title);

        return redirect()->route(
            MODULE.'.list_oab_pemeriksaan_laboratorium',
            ['id' => $id, 'follow_up_id' => $follow_up_id]
        );
    }

    public function detail_oab_pemeriksaan_laboratorium($id, $follow_up_id): View
    {
        $temp = OAB_pemeriksaan_laboratorium::findOrFail($id);

        $pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );

        $default = $temp;

        return $this->_form_oab_pemeriksaan_laboratorium($id, $follow_up_id, $default, 'detail');
    }

    public function update_oab_pemeriksaan_laboratorium_process(
        Request $request, $id, $follow_up_id
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
            MODULE.'.list_oab_pemeriksaan_laboratorium',
            ['id' => $pasien->id, 'follow_up_id' => $follow_up_id]
        );
    }

}
