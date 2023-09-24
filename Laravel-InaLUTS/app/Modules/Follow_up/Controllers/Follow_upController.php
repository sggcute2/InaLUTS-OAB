<?php

namespace App\Modules\Follow_up\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Follow_up\Models\Follow_up as ModuleModel;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up;
use App\Modules\Pasien\Models\Pasien;
use App\Modules\Pasien\Models\OAB\OAB_diagnosis;
use App\Modules\Pasien\Models\OAB\OAB_terapi_medikamentosa;
use App\Modules\Pasien\Models\OAB\OAB_terapi_operatif;
use App\Modules\Pasien\Models\OAB\OAB_terapi_operatif_injeksi_botox;
use BS;
use DT;
use FORM;
use FORMAT;

use App\Modules\Follow_up\Controllers\Traits\OABTrait;

class Follow_upController extends Controller
{
    use OABTrait;

    public function __construct(){
        parent::__construct([
            'module' => 'follow_up',
            'title' => 'Follow Up',
        ]);
    }

    public function index(): View
    {
        $form_action = route(MODULE.'.search');

        $pasien = null;
        if (request()->get('pasien_id')) {
            $pasien = Pasien::findOrFail(request()->get('pasien_id'));
        }

        return $this->moduleView('index', [
            'form_action' => $form_action,
            'pasien' => $pasien,
        ]);
    }

    public function search_process(Request $request): RedirectResponse
    {
        $rules = [
            'nik' => 'required',
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

        $nik = trim($request->get('nik'));
        $pasien = Pasien::where('nik', $nik)->first();
        if ($pasien === null) {
            // Not Existing
            return redirect()->route(MODULE.'.index', [
                'not_existing' => 1,
                'nik' => $nik,
            ]);
        } else {
            // Existing
            return redirect()->route(MODULE.'.index', [
                'existing' => 1,
                'pasien_id' => $pasien->id,
            ]);
        }
    }

    public function _index(): View
    {
        $this->moduleAllow('view');

        $column = array();
        $column[] = array('Nama '.MODULE_TITLE, 'name');
        $column[] = array('Action', function($row) {
            if ($this->moduleAllow('edit', false)) {
                return
                    BS::button(
                        'Edit',
                        route(MODULE.'.edit', $row['id']),
                        false
                    );
            } else {
                return '';
            }

        });
        DT::add(false, ModuleModel::all(), $column);

        return $this->moduleView('index');
    }

    private function _form(
        $pasien_id = 0, $id = 0, $default = [], $mode = 'add'
    ): View
    {
        $old = session()->getOldInput();
        if ($old) $default = $old;

        $pasien = Pasien::findOrFail($pasien_id);

        //dd($default);

        /*
        $form_action = ($pasien_id)
            ? route(MODULE.'.edit', $id)
            : route(MODULE.'.add');
        */
        if ($mode == 'add') {
            $form_action = route(MODULE.'.add', ['pasien_id' => $pasien_id]);
        }
        //dd($form_action);

        $OAB_diagnosis = $OAB_terapi_medikamentosa = $OAB_terapi_operatif
            = null;
        if ($mode == 'add') {
            $OAB_diagnosis =
                OAB_diagnosis::where('pasien_id', $pasien_id)
                    ->first();
            $ns = 'OAB_diagnosis_';
            foreach($OAB_diagnosis->toArray() as $field => $v){
                $default[$ns.$field] = $v;
            }

            $OAB_terapi_medikamentosa =
                OAB_terapi_medikamentosa::where('pasien_id', $pasien_id)
                    ->first();
            $ns = 'OAB_terapi_medikamentosa_';
            foreach($OAB_terapi_medikamentosa->toArray() as $field => $v){
                $default[$ns.$field] = $v;
            }

            $OAB_terapi_operatif =
                OAB_terapi_operatif::where('pasien_id', $pasien_id)
                    ->first();
            $ns = 'OAB_terapi_operatif_';
            foreach($OAB_terapi_operatif->toArray() as $field => $v){
                $default[$ns.$field] = $v;
            }
            /*
            dump(
                $OAB_diagnosis, $OAB_terapi_medikamentosa, $OAB_terapi_operatif
            );exit;
            */

            $data = OAB_terapi_operatif_injeksi_botox::where(
                    'pasien_id', $pasien_id
                )
                ->orderBy('injeksi_botox_date', 'desc')
                ->get();
            $column = array();
            $column[] = array('Tanggal', function($row){
                return FORMAT::date($row['injeksi_botox_date']);
            });
            $column[] = array('Tindakan', 'injeksi_botox_tindakan');
            DT::add('injeksi_botox', $data, $column);
        }

        $view = '';
        switch($pasien->registry_id) {
            case 1:
                $view = 'OAB/form';
                break;
        }
        if ($view == '') abort(403, 'Registry not found ('.__LINE__.')');

        return $this->moduleView($view, [
            'mode' => $mode,
            'pasien_id' => $pasien_id,
            'default' => $default,
            'page_title' => 'Tambah '.MODULE_TITLE,
            //FORM::title($pasien_id, MODULE_TITLE),
            'form_action' => $form_action,
            'OAB_diagnosis' => $OAB_diagnosis,
            'OAB_terapi_medikamentosa' => $OAB_terapi_medikamentosa,
            'OAB_terapi_operatif' => $OAB_terapi_operatif,
        ]);
    }

    public function add($pasien_id): View
    {
        $this->moduleAllow('add');

        $default = [];

        return $this->_form($pasien_id, 0, $default, 'add');
    }

    public function add_process($pasien_id, Request $request): RedirectResponse
    {
        $this->moduleAllow('add');

        $rules = [
            'pemeriksaan_date' => 'required',
        ];
        $attributes = [
            'pemeriksaan_date' => 'Tanggal Pemeriksaan',
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

        $pasien = Pasien::findOrFail($pasien_id);

        $data = $data2 = null;
        switch($pasien->registry_id) {
            case 1:
                $data = $request->all();
                $data['pasien_id'] = $pasien_id;
                $OAB_diagnosis =
                    OAB_diagnosis::where('pasien_id', $pasien_id)
                        ->first();
                $OAB_terapi_medikamentosa =
                    OAB_terapi_medikamentosa::where('pasien_id', $pasien_id)
                        ->first();
                $OAB_terapi_operatif =
                    OAB_terapi_operatif::where('pasien_id', $pasien_id)
                        ->first();
                /*
                dump(
                    $OAB_diagnosis,
                    $OAB_terapi_medikamentosa,
                    $OAB_terapi_operatif
                );exit;
                */
        
                $OAB_terapi_operatif_injeksi_botox =
                    OAB_terapi_operatif_injeksi_botox::where(
                        'pasien_id', $pasien_id
                    )
                    ->orderBy('injeksi_botox_date', 'desc')
                    ->get();
        
                $data2['diagnosis_terakhir'] = serialize(
                    $OAB_diagnosis->toArray()
                );
                $data2['terapi_medikamentosa_terakhir'] = serialize(
                    $OAB_terapi_medikamentosa->toArray()
                );
                $data2['terapi_operatif_terakhir'] = serialize(
                    $OAB_terapi_operatif->toArray()
                );
                $data2['terapi_operatif_injeksi_botox_terakhir'] = serialize(
                    $OAB_terapi_operatif_injeksi_botox->toArray()
                );
                //dd($data);
                break;
        }
        if ($data === null) abort(403, 'Registry not found ('.__LINE__.')');

        $id = ModuleModel::base_insert($data);
        //dd($id);
        switch($pasien->registry_id) {
            case 1:
                $data2['follow_up_id'] = $id;
                OAB_follow_up::base_insert($data2);
                break;
        }

        //$this->flash_success_add();

        return redirect()->route(MODULE.'.detail', [
            'pasien_id' => $pasien_id,
            'id' => $id,
        ]);
    }

    //
    public function edit($id): View
    {
        $this->moduleAllow('edit');

        $default = ModuleModel::findOrFail($id);

        return $this->_form($id, $default);
    }

    //
    public function edit_process(Request $request, $id): RedirectResponse
    {
        $this->moduleAllow('edit');

        $default = ModuleModel::findOrFail($id);

        $rules = [
            'name' => 'required|unique:m_dokter_pemeriksa,name,'.$id,
        ];
        $attributes = [
            'name' => 'Nama '.MODULE_TITLE,
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

    public function detail($pasien_id, $id): View
    {
        $pasien = Pasien::findOrFail($pasien_id);

        $data = $data2 = null;
        switch($pasien->registry_id) {
            case 1:
                $this->detail_oab($pasien_id, $id);
                break;

            default:
                abort(403, 'Registry not found ('.__LINE__.')');
                break;
        }
    }
}
