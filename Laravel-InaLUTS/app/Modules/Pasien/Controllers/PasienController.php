<?php

namespace App\Modules\Pasien\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Pasien\Models\Pasien as ModuleModel;
use App\Modules\Pasien\Models\Pasien_pilihan_penyakit;
use App\Modules\Datang\Models\Datang;
use App\Modules\Unit_pelayanan\Models\Unit_pelayanan;
use App\Modules\Pendidikan\Models\Pendidikan;
use App\Modules\Pekerjaan\Models\Pekerjaan;
use App\Modules\Status_pernikahan\Models\Status_pernikahan;
use App\Modules\Aktivitas_seksual\Models\Aktivitas_seksual;
use App\Modules\Suku\Models\Suku;
use App\Modules\Jaminan_kesehatan\Models\Jaminan_kesehatan;
use App\Modules\Jenis_kelamin\Models\Jenis_kelamin;
use App\Modules\Propinsi\Models\Propinsi;
use App\Modules\Kabupaten\Models\Kabupaten;
use App\Modules\Registry\Models\Registry;
use BS;
use DT;
use FORM;

use App\Modules\Pasien\Controllers\Traits\OABTrait;

class PasienController extends Controller
{
    use OABTrait;

    public function __construct(){
        parent::__construct([
            'module' => 'pasien',
            'title' => 'Pasien',
        ]);
    }

    private function _allow_access($id): ModuleModel
    {
        $default = ModuleModel::findOrFail($id);
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

    private function _get_code($hospital_ID = 0): string
    {
        $y = date('y');
        $m = ModuleModel::where('code', 'LIKE', '%'.$y.'%')->max('code');

        if ($m) {
            $n = intval(substr($m, -4)) + 1;
        } else {
            $n = 1;
        }
        $ret = $y.str_repeat('0', 4 - strlen($n)).$n;
        //dd($ret);

        return $ret;
    }

    public function index(): View
    {
        $this->moduleAllow('view');

        if (USER_IS_REG_COO || USER_IS_LOC_COO || USER_IS_SUB) {
            $data = ModuleModel::where('rumah_sakit_id', USER_RUMAH_SAKIT_ID)
                ->get();
        } else {
            $data = ModuleModel::all();
        }
        $column = array();
        $column[] = array('Nama '.MODULE_TITLE, 'name');
        $column[] = array('Action', function($row) {
            $detail = BS::button(
                'Detail',
                route(MODULE.'.detail', $row['id']),
                false
            );

            if ($this->moduleAllow('edit', false)) {
                return
                    BS::button(
                        'Edit',
                        route(MODULE.'.edit', $row['id']),
                        false
                    ).' '.$detail;
            } else {
                return $detail;
            }

        });
        DT::add(false, $data, $column);

        return $this->moduleView('index');
    }

    private function _form($id = 0, $default = [], $mode = ''): View
    {
        $old = session()->getOldInput();
        if ($old) $default = $old;

        //dd($default);
        if ($mode == 'add') $default['code'] = $this->_get_code();

        $form_action = ($id)
            ? route(MODULE.'.edit', $id)
            : route(MODULE.'.add');

        $m_datang = Datang::all();
        $m_unit_pelayanan = Unit_pelayanan::all();
        $m_pendidikan = Pendidikan::all();
        $m_pekerjaan = Pekerjaan::orderBy('pos', 'asc')->get();
        $m_status_pernikahan = Status_pernikahan::all();
        $m_aktivitas_seksual = Aktivitas_seksual::all();
        $m_suku = Suku::orderBy('pos', 'asc')->get();
        $m_jaminan_kesehatan = Jaminan_kesehatan::orderBy('pos', 'asc')->get();
        $m_jenis_kelamin = Jenis_kelamin::all();
        $m_propinsi = Propinsi::all();
        $m_kabupaten = Kabupaten::all();

        $page_title = ($mode == 'detail')
            ? 'Identitas'
            : FORM::title($id, MODULE_TITLE);

        return $this->moduleView('form', [
            'id' => $id,
            'default' => $default,
            'page_title' => $page_title,
            'form_action' => $form_action,
            'mode' => $mode,
            'm_datang' => $m_datang,
            'm_unit_pelayanan' => $m_unit_pelayanan,
            'm_pendidikan' => $m_pendidikan,
            'm_pekerjaan' => $m_pekerjaan,
            'm_status_pernikahan' => $m_status_pernikahan,
            'm_aktivitas_seksual' => $m_aktivitas_seksual,
            'm_suku' => $m_suku,
            'm_jaminan_kesehatan' => $m_jaminan_kesehatan,
            'm_jenis_kelamin' => $m_jenis_kelamin,
            'm_propinsi' => $m_propinsi,
            'm_kabupaten' => $m_kabupaten,
        ]);
    }

    public function add(): View
    {
        $this->moduleAllow('add');

        $default = [];
        if (request()->get('nik')) {
            $default['nik'] = trim(request()->get('nik'));
        }

        return $this->_form(0, $default, 'add');
    }

    public function add_process(Request $request): RedirectResponse
    {
        $this->moduleAllow('add');

        $rules = [
            'nik' => 'required|max:50|unique:m_pasien,nik',
        ];
        $attributes = [
            'nik' => 'NIK',
        ];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $this->get_validator_messages(),
            $attributes
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $default = $request->all();
        $default['rumah_sakit_id'] = USER_RUMAH_SAKIT_ID;
        $default['code'] = $this->_get_code();
        $default['propinsi_id'] = (int) $default['propinsi_id'];
        $default['kabupaten_id'] = (int) $default['kabupaten_id'];
        $default['pendidikan_id'] = (int) $default['pendidikan_id'];
        $default['pekerjaan_id'] = (int) $default['pekerjaan_id'];
        $default['status_pernikahan_id'] = (int) $default['status_pernikahan_id'];
        $default['aktivitas_seksual_id'] = (int) $default['aktivitas_seksual_id'];
        $default['suku_id'] = (int) $default['suku_id'];
        $default['datang_id'] = (int) $default['datang_id'];
        $default['jaminan_kesehatan_id'] = (int) $default['jaminan_kesehatan_id'];
        $default['unit_pelayanan_id'] = (int) $default['unit_pelayanan_id'];
        //dd($default);

        ModuleModel::base_insert($default);

        $this->flash_success_add();

        return redirect()->route(MODULE.'.index');
    }

    public function edit($id): View
    {
        $this->moduleAllow('edit');

        $default = $this->_allow_access($id);

        return $this->_form($id, $default, 'edit');
    }

    public function edit_process(Request $request, $id): RedirectResponse
    {
        $this->moduleAllow('edit');

        $default = $this->_allow_access($id);

        $rules = [
            'nik' => 'required|max:50|unique:m_pasien,nik,'.$id,
        ];
        $attributes = [
            'nik' => 'NIK',
        ];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $this->get_validator_messages(),
            $attributes
        );
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ModuleModel::base_update_by_id($request->all(), $id);

        $this->flash_success_edit();

        return redirect()->route(MODULE.'.index');
    }

    public function post_ajax_check_nik(Request $request)
    {
        $count_nik = ModuleModel::where('nik', $request->nik)
            ->count('nik');

        if ($count_nik > 0) {
            return response()->json(['success'=>'NIK Duplikat']);
        }else{
            return response()->json(['success'=>'NIK Tidak Duplikat']);
        }
    }

    public function detail($id): View
    {
        $default = $this->_allow_access($id);

        return $this->_form($id, $default, 'detail');
    }

    public function detail_pilihan_penyakit($id): View
    {
        $pasien = $this->_allow_access($id);

        if (!Pasien_pilihan_penyakit::where('pasien_id', $id)->exists()) {
            Pasien_pilihan_penyakit::base_insert(['pasien_id' => $id]);
        }
        $default = Pasien_pilihan_penyakit::where('pasien_id', $id)->first();
        $page_title = 'Pilihan Penyakit';
        $view = $this->_get_method(__METHOD__);
        $form_action = route(
            'pasien.update_'.str_replace('detail_', '', $view),
            $id
        );

        $m_registry = Registry::where('id', 1)->get();

        return $this->moduleView('form_'.str_replace('detail_', '', $view), [
            'default' => $default,
            'page_title' => $page_title,
            'form_action' => $form_action,
            'm_registry' => $m_registry,
        ]);
    }

    public function update_pilihan_penyakit_process(Request $request, $id): RedirectResponse
    {
        $pasien = $this->_allow_access($id);

        $page_title = 'Pilihan Penyakit';

        Pasien_pilihan_penyakit::base_update_by_pasien_id($request->all(), $id);
        ModuleModel::base_update_by_id([
            'registry_id' => intval($request->get('registry_id'))
        ], $id);

        $this->flash_success_update($page_title);

        //return redirect()->route(MODULE.'.detail_pilihan_penyakit', $id);
        return redirect()->route(MODULE.'.detail_oab_anamnesis', $id);
    }
}
