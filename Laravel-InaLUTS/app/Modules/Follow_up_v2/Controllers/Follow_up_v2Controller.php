<?php

namespace App\Modules\Follow_up_v2\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View as ViewPasien;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Follow_up_v2\Models\Follow_up as ModuleModel;
use App\Modules\Follow_up_v2\Models\Follow_up_v2;
//use App\Modules\Follow_up_v2\Models\OAB\OAB_follow_up_detail;
use App\Modules\Follow_up_v2\Models\OAB\OAB_pemeriksaan_laboratorium;
use App\Modules\Follow_up_v2\Models\OAB\OAB_terapi_operatif_injeksi_botox;
use App\Modules\Pasien\Models\Pasien;
/*
use App\Modules\Pasien\Models\OAB\OAB_diagnosis;
use App\Modules\Pasien\Models\OAB\OAB_terapi_medikamentosa;
use App\Modules\Pasien\Models\OAB\OAB_terapi_operatif;
use App\Modules\Pasien\Models\OAB\OAB_terapi_operatif_injeksi_botox;
*/
use App\Modules\Rumah_sakit\Models\Rumah_sakit;
use BS;
use DT;
use FORM;
use FORMAT;

use App\Modules\Follow_up_v2\Controllers\Traits\OABTrait;

class Follow_up_v2Controller extends Controller
{
    use OABTrait;

    public function __construct(){
        ViewPasien::addNamespace(
            'Pasien',
            app_path('/Modules/Pasien/Views')
        );

        if (
            request()->segment(4) == 'detail_oab_terapi_operatif_injeksi_botox'
            || request()->segment(4) == 'update_oab_terapi_operatif_injeksi_botox'
        ) {
            $temp = OAB_terapi_operatif_injeksi_botox::find((int) request()->segment(2));

            $follow_up = Follow_up_v2::where('pasien_id', (int) $temp->pasien_id)
                ->where('id', (int) request()->segment(3))
                ->first();
        } else if (
            request()->segment(4) == 'detail_oab_pemeriksaan_laboratorium'
            || request()->segment(4) == 'update_oab_pemeriksaan_laboratorium'
        ) {
            $temp = OAB_pemeriksaan_laboratorium::find((int) request()->segment(2));

            $follow_up = Follow_up_v2::where('pasien_id', (int) $temp->pasien_id)
                ->where('id', (int) request()->segment(3))
                ->first();
        } else {
            $follow_up = Follow_up_v2::where('pasien_id', (int) request()->segment(2))
                ->where('id', (int) request()->segment(3))
                ->first();
        }

        define('PAGE_IS_FOLLOW_UP', true);
        define('FOLLOW_UP___TITLE', 'Follow Up , Tanggal : '
            .FORMAT::date($follow_up->pemeriksaan_date)
        );

        parent::__construct([
            'module' => 'follow_up_v2',
            'title' => 'Follow Up',
        ]);
    }

    private function _allow_access($id): Pasien
    {
        $default = Pasien::findOrFail($id);
        if ($default->rumah_sakit_id != USER_RUMAH_SAKIT_ID) {
            abort(403, 'Access Denied ('.__LINE__.')');
        }
        if ($default->created_user_id != USER_ID) {
            abort(403, 'Access Denied ('.__LINE__.')');
        }

        return $default;
    }

    private function _get_method($method = ''): string
    {
        $x = explode('::', basename($method));

        return (count($x) == 2) ? $x[1] : $x[0];
    }

    public function index(): View
    {
        die('Disabled');
    }

    //===[ Begin : Pemeriksaan Laboratorium ]===================================
    public function _NOT_USED_list_oab_pemeriksaan_laboratorium($pasien_id, $id): View
    {
    }

    private function _NOT_USED__form_oab_pemeriksaan_laboratorium(
        $pasien_id = 0, $id = 0, $default = [], $mode = ''
    ): View
    {
        $view = 'form_pemeriksaan_laboratorium';
        $page_title  = ($mode == 'detail') ? '' : 'Add ';
        $page_title .= 'Pemeriksaan Laboratorium';
        //dd($mode);
        if ($mode == 'detail') {
            $form_action = route(
                'follow_up.'.str_replace('form_', 'update_oab_', $view),
                [
                    'pasien_id' => $pasien_id,
                    'id' => $id,
                ]
            );
        } else {
            // $id = oab_follow_up.id
            $form_action = route(
                'follow_up.'.str_replace('form_', 'add_oab_', $view),
                [
                    'id' => $pasien_id,
                    'follow_up_id' => $id,
                ]
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

    public function _NOT_USED_add_oab_pemeriksaan_laboratorium($pasien_id, $id): View
    {
        // [TODO] set allow access
        //$pasien = $this->_allow_access($id);

        $default = [];

        return $this->_form_oab_pemeriksaan_laboratorium($pasien_id, $id, $default, 'add');
    }

    public function _NOT_USED_add_oab_pemeriksaan_laboratorium_process(
        Request $request, $pasien_id, $id
    ): RedirectResponse
    {
        // [TODO] set allow access
        //$pasien = $this->_allow_access($id);

        $page_title = 'Pemeriksaan Laboratorium';

        $data = $request->all();
        $data['pasien_id'] = $pasien_id;
        $data['follow_up_id'] = $id;

        OAB_follow_up_pemeriksaan_laboratorium::base_insert($data);

        $data2 = [];
        $data2['pemeriksaan_penunjang_pemeriksaan_laboratorium'] = 'Ya';
        OAB_follow_up_detail::base_update($data2, "
            pasien_id = $pasien_id AND follow_up_id = $id
        ");

        $this->flash_success_add($page_title);

        return redirect()->route(
            'follow_up.detail', [
                'pasien_id' => $pasien_id,
                'id' => $id,
            ]
        );
    }

    public function _NOT_USED_detail_oab_pemeriksaan_laboratorium($pasien_id, $id): View
    {
        $temp = OAB_follow_up_pemeriksaan_laboratorium::findOrFail($id);
        //dd($temp);
        /*$pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );
        */

        $default = $temp;
        //dd($default->toArray());

        return $this->_form_oab_pemeriksaan_laboratorium($pasien_id, $id, $default, 'detail');
    }

    public function _NOT_USED_update_oab_pemeriksaan_laboratorium_process(
        Request $request, $pasien_id, $id
    ): RedirectResponse
    {
        $temp = OAB_follow_up_pemeriksaan_laboratorium::findOrFail($id);
        //dd($temp->follow_up_id);
        /*
        $pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );
        */

        $page_title = 'Pemeriksaan Laboratorium';

        $data = $request->all();

        OAB_follow_up_pemeriksaan_laboratorium::base_update_by_id(
            $data, $id
        );

        $data2 = [];
        $data2['pemeriksaan_penunjang_pemeriksaan_laboratorium'] = 'Ya';
        //dd($data2);
        OAB_follow_up_detail::base_update($data2, "
            pasien_id = $pasien_id AND follow_up_id = {$temp->follow_up_id}
        ");

        $this->flash_success_update($page_title);

        return redirect()->route(
            'follow_up.detail', [
                'pasien_id' => $pasien_id,
                'id' => $temp->follow_up_id,
            ]
        );
    }
    //===[ End : Pemeriksaan Laboratorium ]=====================================

    //===[ Begin : Terapi : Operatif : Injeksi Botox ]==========================
    public function _NOT_USED_list_oab_terapi_operatif_injeksi_botox($pasien_id, $id): View
    {
    }

    private function _NOT_USED__form_oab_terapi_operatif_injeksi_botox(
        $pasien_id = 0, $id = 0, $default = [], $mode = ''
    ): View
    {
        $view = 'form_terapi_operatif_injeksi_botox';
        $page_title  = ($mode == 'detail') ? '' : 'Add ';
        $page_title .= 'Injeksi Botox';
        //dd($mode);
        if ($mode == 'detail') {
            $form_action = route(
                'follow_up.'.str_replace('form_', 'update_oab_', $view),
                [
                    'pasien_id' => $pasien_id,
                    'id' => $id,
                ]
            );
        } else {
            // $id = oab_follow_up.id
            $form_action = route(
                'follow_up.'.str_replace('form_', 'add_oab_', $view),
                [
                    'pasien_id' => $pasien_id,
                    'id' => $id,
                ]
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

    public function _NOT_USED_add_oab_terapi_operatif_injeksi_botox($pasien_id, $id): View
    {
        // [TODO] set allow access
        //$pasien = $this->_allow_access($id);

        $default = [];

        return $this->_form_oab_terapi_operatif_injeksi_botox($pasien_id, $id, $default, 'add');
    }

    public function _NOT_USED_add_oab_terapi_operatif_injeksi_botox_process(
        Request $request, $pasien_id, $id
    ): RedirectResponse
    {
        // [TODO] set allow access
        //$pasien = $this->_allow_access($id);

        $follow_up = OAB_follow_up_detail::where('pasien_id', $pasien_id)
            ->where('follow_up_id', $id)
            ->first();
        $data_follow_up__terapi_operatif_ya = [];
        try {
            $data_follow_up__terapi_operatif_ya = unserialize($follow_up['terapi_operatif_ya']);
        } catch (Exception $exception) {
            $data_follow_up__terapi_operatif_ya = [];
        }
        $data_follow_up__terapi_operatif_ya['terapi_operatif_injeksi_botox'] = 'Ya';
        //dd($data_follow_up__terapi_operatif_ya);

        $page_title = 'Injeksi Botox';

        $data = $request->all();
        $data['pasien_id'] = $pasien_id;
        $data['follow_up_id'] = $id;

        OAB_follow_up_terapi_operatif_injeksi_botox::base_insert($data);

        $data2 = [];
        $data2['terapi_operatif'] = 'Ya';
        $data2['terapi_operatif_ya'] = serialize($data_follow_up__terapi_operatif_ya);
        OAB_follow_up_detail::base_update($data2, "
            pasien_id = $pasien_id AND follow_up_id = $id
        ");

        $this->flash_success_add($page_title);

        return redirect()->route(
            'follow_up.detail', [
                'pasien_id' => $pasien_id,
                'id' => $id,
            ]
        );
    }

    public function _NOT_USED_detail_oab_terapi_operatif_injeksi_botox($pasien_id, $id): View
    {
        $temp = OAB_follow_up_terapi_operatif_injeksi_botox::findOrFail($id);
        //dd($temp);
        /*$pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );
        */

        $default = $temp;
        //dd($default->toArray());

        return $this->_form_oab_terapi_operatif_injeksi_botox($pasien_id, $id, $default, 'detail');
    }

    public function _NOT_USED_update_oab_terapi_operatif_injeksi_botox_process(
        Request $request, $pasien_id, $id
    ): RedirectResponse
    {
        $temp = OAB_follow_up_terapi_operatif_injeksi_botox::findOrFail($id);
        //dd($temp->follow_up_id);
        /*
        $pasien = $this->_allow_access(
            isset($temp->pasien_id) ? $temp->pasien_id : 0
        );
        */

        $follow_up = OAB_follow_up_detail::where('pasien_id', $pasien_id)
            ->where('follow_up_id', $temp->follow_up_id)
            ->first();
        $data_follow_up__terapi_operatif_ya = [];
        try {
            $data_follow_up__terapi_operatif_ya = unserialize($follow_up['terapi_operatif_ya']);
        } catch (Exception $exception) {
            $data_follow_up__terapi_operatif_ya = [];
        }
        $data_follow_up__terapi_operatif_ya['terapi_operatif_injeksi_botox'] = 'Ya';
        //dd($data_follow_up__terapi_operatif_ya);

        $page_title = 'Injeksi Botox';

        $data = $request->all();

        OAB_follow_up_terapi_operatif_injeksi_botox::base_update_by_id(
            $data, $id
        );

        $data2 = [];
        $data2['terapi_operatif'] = 'Ya';
        $data2['terapi_operatif_ya'] = serialize($data_follow_up__terapi_operatif_ya);
        //dd($data2);
        OAB_follow_up_detail::base_update($data2, "
            pasien_id = $pasien_id AND follow_up_id = {$temp->follow_up_id}
        ");

        $this->flash_success_update($page_title);

        return redirect()->route(
            'follow_up.detail', [
                'pasien_id' => $pasien_id,
                'id' => $temp->follow_up_id,
            ]
        );
    }
    //===[ End : Terapi : Operatif : Injeksi Botox ]============================

}
