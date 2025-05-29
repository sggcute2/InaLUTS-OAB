<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Modules\Pasien\Models\Pasien;
use App\Modules\Rumah_sakit\Models\Rumah_sakit;
use App\Modules\Pasien\Models\OAB\OAB_pemeriksaan_laboratorium;
use App\Modules\Follow_up_v2\Models\OAB\OAB_pemeriksaan_laboratorium as follow_up_v2_OAB_pemeriksaan_laboratorium;
use App\Modules\Pasien\Models\OAB\OAB_sistem_skor;
use App\Modules\Follow_up_v2\Models\OAB\OAB_sistem_skor as follow_up_v2_OAB_sistem_skor;
use App\Modules\Pasien\Models\OAB\OAB_terapi;
use App\Modules\Follow_up_v2\Models\OAB\OAB_terapi as follow_up_v2_OAB_terapi;
use App\Modules\Pasien\Models\OAB\OAB_terapi_operatif_injeksi_botox;
use App\Modules\Follow_up_v2\Models\OAB\OAB_terapi_operatif_injeksi_botox as follow_up_v2_OAB_terapi_operatif_injeksi_botox;
use Session;
use Lang;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct($args = [])
    {
        if (isset($args['module'])) {
            define('MODULE', $args['module']);

            View::addNamespace(
                MODULE,
                app_path('/Modules/' . ucfirst(MODULE) . '/Views')
            );
        } else {
            abort('403', 'Module not defined');
        }

        if (isset($args['title'])) {
            define('MODULE_TITLE', $args['title']);
        } else {
            define('MODULE_TITLE', '');
        }

        $a = \Request::route()->getName() ?? '';
        $x = explode('.', $a);
        if (count($x) == 2) {
          define('ACTION', $x[1]);
          define('ROUTE', $a);
        } else {
          define('ACTION', '');
          define('ROUTE', $a);
        }

        define('ADD', ACTION == 'add');
        define('EDIT', ACTION == 'edit');
        define('ID', intval(\Request::segment(2)));
        define('IS_DETAIL_PASIEN',
            substr(ROUTE, 0, 13) == 'pasien.detail'
            || ACTION == 'list_oab_pemeriksaan_laboratorium'
        );

        if ((IS_DETAIL_PASIEN || defined('PAGE_IS_FOLLOW_UP')) && ID) {
            if (ACTION == 'detail_oab_pemeriksaan_laboratorium') {
                if (defined('PAGE_IS_FOLLOW_UP')) {
                    $temp = follow_up_v2_OAB_pemeriksaan_laboratorium::find(ID);
                } else {
                    $temp = OAB_pemeriksaan_laboratorium::find(ID);
                }
                $data_pasien = Pasien::find($temp->pasien_id);
            } else if (ACTION == 'detail_oab_terapi_operatif_injeksi_botox') {
                if (defined('PAGE_IS_FOLLOW_UP')) {
                    $temp = follow_up_v2_OAB_terapi_operatif_injeksi_botox::find(ID);
                    $data_pasien = Pasien::find($temp->pasien_id);
                } else {
                    $temp = OAB_terapi_operatif_injeksi_botox::find(ID);
                    $data_pasien = Pasien::find($temp->pasien_id);
                }
            } else {
                $data_pasien = Pasien::find(ID);
            }

            if (defined('PAGE_IS_FOLLOW_UP')) {
                $sistem_skor = follow_up_v2_OAB_sistem_skor::where(
                    'pasien_id', $data_pasien->id
                )
                ->where('follow_up_id', (int) request()->segment(3))
                ->first();
                $terapi = follow_up_v2_OAB_terapi::where(
                    'pasien_id', $data_pasien->id
                )
                ->where('follow_up_id', (int) request()->segment(3))
                ->first();
            } else {
                $sistem_skor = OAB_sistem_skor::where(
                    'pasien_id', $data_pasien->id
                )->first();
                $terapi = OAB_terapi::where(
                    'pasien_id', $data_pasien->id
                )->first();
            }

            \View::share('data_pasien', $data_pasien);
            \View::share('sistem_skor', $sistem_skor);
            \View::share('terapi', $terapi);
        }
    }

    public function moduleView($view = '', $data = [])
    {
        return View::make(MODULE . '::' . $view, $data);
    }

    public function moduleAllow($action = '', $abortIfDeny = true)
    {
        if (Gate::allows(MODULE.'-'.$action)) {
            return true;
        } else {
            if ($abortIfDeny) {
                abort(403);
            } else {
                return false;
            }
        }
    }

    # Flash for Success Add
    public function flash_success_add($title = ''){
        $title = (trim($title) == '') ? MODULE_TITLE : trim($title);
        Session::flash('success',
            Lang::get('message.success_add', ['title' => $title])
        );
    }

    # Flash for Success Edit
    public function flash_success_edit($title = ''){
        $title = (trim($title) == '') ? MODULE_TITLE : trim($title);
        Session::flash('success',
            Lang::get('message.success_edit', ['title' => $title])
        );
    }

    # Flash for Success Update
    public function flash_success_update($title = ''){
        $title = (trim($title) == '') ? MODULE_TITLE : trim($title);
        Session::flash('success',
            Lang::get('message.success_update', ['title' => $title])
        );
    }

    # Flash for Success delete
    public function flash_success_delete($title = ''){
        $title = (trim($title) == '') ? MODULE_TITLE : trim($title);
        Session::flash('success',
            Lang::get('message.success_delete', ['title' => $title])
        );
    }

    # Flash for Success clear
    public function flash_success_clear($title = ''){
        $title = (trim($title) == '') ? MODULE_TITLE : trim($title);
        Session::flash('success',
            Lang::get('message.success_clear', ['title' => $title])
        );
    }

    # Validator messages
    public function get_validator_messages(){
        $messages = [
            'required' => 'The :attribute field is required.',
            'same' => 'The :attribute and :other must match.',
            'size' => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is '
                .'not between :min - :max.',
            'in' => 'The :attribute must be one of '
                .'the following types: :values',
        ];

        return $messages;
    }
}
