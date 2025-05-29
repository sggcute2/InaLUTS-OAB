<?php

namespace App\Modules\Follow_up\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Follow_up\Models\Follow_up as ModuleModel;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_detail;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_pemeriksaan_laboratorium;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_terapi_operatif_injeksi_botox;
use App\Modules\Pasien\Models\Pasien;
use App\Modules\Pasien\Models\OAB\OAB_diagnosis;
use App\Modules\Pasien\Models\OAB\OAB_terapi_medikamentosa;
use App\Modules\Pasien\Models\OAB\OAB_terapi_operatif;
use App\Modules\Pasien\Models\OAB\OAB_terapi_operatif_injeksi_botox;
use App\Modules\Rumah_sakit\Models\Rumah_sakit;
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

    private function _get_method($method = ''): string
    {
        $x = explode('::', basename($method));

        return (count($x) == 2) ? $x[1] : $x[0];
    }

    public function index(): View
    {
        $form_action = route(MODULE.'.search');

        $pasien = null;
        if (request()->get('pasien_id')) {
            $pasien_id = (int) request()->get('pasien_id');
            $pasien = Pasien::findOrFail($pasien_id);

            $column = array();
            $column[] = array('Tanggal Pemeriksaan', function($row) {
                return FORMAT::date($row['pemeriksaan_date']);
            });
            $column[] = array('Action', function($row) {
                //if ($this->moduleAllow('edit', false)) {
                if ($row['rumah_sakit_id'] == USER_RUMAH_SAKIT_ID) {
                    return
                        BS::button(
                            'Edit',
                            route(MODULE.'.edit', [
                                'pasien_id' => $row['pasien_id'],
                                'id' => $row['id']
                            ]),
                            false
                        ).
                        '&nbsp;'
                        .BS::button(
                            'Detail',
                            route('follow_up_v2.detail_oab_anamnesis', [
                                'id' => $row['pasien_id'],
                                'follow_up_id' => $row['id']
                            ]),
                            false
                        );
                } else {
                    return '';
                }    
            });
            DT::add(false, ModuleModel::where('pasien_id', $pasien_id)
                ->orderBy('pemeriksaan_date', 'desc')
                ->get(),
                $column
            );
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
        } else if ($mode == 'edit') {
            $form_action = route(MODULE.'.edit', [
                'pasien_id' => $pasien_id,
                'id' => $id
            ]);
        }
        //dd($form_action);

        $OAB_diagnosis = $OAB_terapi_medikamentosa = $OAB_terapi_operatif
            = null;
        //if ($mode == 'add') {
            $OAB_diagnosis =
                OAB_diagnosis::where('pasien_id', $pasien_id)
                    ->first();
            $ns = 'OAB_diagnosis_';
            if ($OAB_diagnosis !== null) {
                foreach($OAB_diagnosis->toArray() as $field => $v){
                    $default[$ns.$field] = $v;
                }
            }

            $OAB_terapi_medikamentosa =
                OAB_terapi_medikamentosa::where('pasien_id', $pasien_id)
                    ->first();
            $ns = 'OAB_terapi_medikamentosa_';
            if ($OAB_terapi_medikamentosa !== null) {
                foreach($OAB_terapi_medikamentosa->toArray() as $field => $v){
                    $default[$ns.$field] = $v;
                }
            }

            $OAB_terapi_operatif =
                OAB_terapi_operatif::where('pasien_id', $pasien_id)
                    ->first();
            $ns = 'OAB_terapi_operatif_';
            if ($OAB_terapi_operatif !== null) {
                foreach($OAB_terapi_operatif->toArray() as $field => $v){
                    $default[$ns.$field] = $v;
                }
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
        //}

        $view = '';
        switch($pasien->registry_id) {
            case 1:
                $view = 'OAB/form';
                break;
        }
        if ($view == '') abort(403, 'Registry not found ('.__LINE__.')');

        $rumah_sakit = null;
        if ($mode == 'edit') {
            $rumah_sakit = Rumah_sakit::find($default['rumah_sakit_id']);
        }

        return $this->moduleView($view, [
            'mode' => $mode,
            'pasien_id' => $pasien_id,
            'rumah_sakit' => $rumah_sakit,
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

                if ($OAB_diagnosis !== null) {
                    $data2['diagnosis_terakhir'] = serialize(
                        $OAB_diagnosis->toArray()
                    );
                }
                if ($OAB_terapi_medikamentosa !== null) {
                    $data2['terapi_medikamentosa_terakhir'] = serialize(
                        $OAB_terapi_medikamentosa->toArray()
                    );
                }
                if ($OAB_terapi_operatif !== null) {
                    $data2['terapi_operatif_terakhir'] = serialize(
                        $OAB_terapi_operatif->toArray()
                    );
                }
                if ($OAB_terapi_operatif_injeksi_botox !== null) {
                    $data2['terapi_operatif_injeksi_botox_terakhir'] = serialize(
                        $OAB_terapi_operatif_injeksi_botox->toArray()
                    );
                }
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

        /*
        return redirect()->route(MODULE.'.detail', [
            'pasien_id' => $pasien_id,
            'id' => $id,
        ]);
        */
        return redirect()->route('follow_up_v2.detail_oab_anamnesis', [
            'pasien_id' => $pasien_id,
            'id' => $id,
        ]);
    }

    //
    public function edit($pasien_id, $id): View
    {
        $this->moduleAllow('edit');

        $default = ModuleModel::findOrFail($id);

        return $this->_form($pasien_id, $id, $default, 'edit');
    }

    //
    public function edit_process(
        Request $request, $pasien_id, $id
    ): RedirectResponse
    {
        $this->moduleAllow('edit');

        $default = ModuleModel::findOrFail($id);

        $rules = [
            //'name' => 'required|unique:m_dokter_pemeriksa,name,'.$id,
            'pemeriksaan_date' => 'required',
        ];
        $attributes = [
            //'name' => 'Nama '.MODULE_TITLE,
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

        ModuleModel::base_update_by_id($request->all(), $id);

        $this->flash_success_edit();

        return redirect()->route(MODULE.'.index', [
            'existing' => 1,
            'pasien_id' => $pasien->id,
        ]);
    }

    public function detail($pasien_id, $id): View
    {
        $pasien = Pasien::findOrFail($pasien_id);

        $data = $data2 = null;
        switch($pasien->registry_id) {
            case 1:
                return $this->detail_oab($pasien_id, $id);
                break;

            default:
                abort(403, 'Registry not found ('.__LINE__.')');
                break;
        }
    }

    //===[ Begin : Pemeriksaan Laboratorium ]===================================
    public function list_oab_pemeriksaan_laboratorium($pasien_id, $id): View
    {
    }

    private function _form_oab_pemeriksaan_laboratorium(
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

    public function add_oab_pemeriksaan_laboratorium($pasien_id, $id): View
    {
        // [TODO] set allow access
        //$pasien = $this->_allow_access($id);

        $default = [];

        return $this->_form_oab_pemeriksaan_laboratorium($pasien_id, $id, $default, 'add');
    }

    public function add_oab_pemeriksaan_laboratorium_process(
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

    public function detail_oab_pemeriksaan_laboratorium($pasien_id, $id): View
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

    public function update_oab_pemeriksaan_laboratorium_process(
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
    public function list_oab_terapi_operatif_injeksi_botox($pasien_id, $id): View
    {
    }

    private function _form_oab_terapi_operatif_injeksi_botox(
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

    public function add_oab_terapi_operatif_injeksi_botox($pasien_id, $id): View
    {
        // [TODO] set allow access
        //$pasien = $this->_allow_access($id);

        $default = [];

        return $this->_form_oab_terapi_operatif_injeksi_botox($pasien_id, $id, $default, 'add');
    }

    public function add_oab_terapi_operatif_injeksi_botox_process(
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

    public function detail_oab_terapi_operatif_injeksi_botox($pasien_id, $id): View
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

    public function update_oab_terapi_operatif_injeksi_botox_process(
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
