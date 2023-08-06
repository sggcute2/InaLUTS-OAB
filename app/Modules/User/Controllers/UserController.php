<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\User as ModuleModel;
use App\Modules\Rumah_sakit\Models\Rumah_sakit;
use App\Modules\Departemen\Models\Departemen;
use App\Enums\UserType;
use BS;
use DT;
use FORM;

class UserController extends Controller
{
    public function __construct(){
        parent::__construct([
            'module' => 'user',
            'title' => 'User',
        ]);
    }

    public function index(): View
    {
        $this->moduleAllow('view');

        $column = array();
        $column[] = array('Username', 'username');
        $column[] = array('Full Name', 'name');
        $column[] = array('Type', function($row){
            return UserType::get_name_by_id($row['type']);
        });
        $column[] = array('Rumah Sakit', function($row){
            return Rumah_sakit::find($row['rumah_sakit_id'])->name ?? '';
        });
        $column[] = array('Departemen', function($row){
            return Departemen::find($row['departemen_id'])->name ?? '';
        });
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
        DT::add(false, ModuleModel::where('id', '<>', 1)->get(), $column);

        return $this->moduleView('index');
    }

    private function _form($id = 0, $default = []): View
    {
        $old = session()->getOldInput();
        if ($old) $default = $old;

        //dd($default);

        $form_action = ($id)
            ? route(MODULE.'.edit', $id)
            : route(MODULE.'.add');

        $user_type = UserType::all_except_admin();
        //dd($user_type);

        $rumah_sakit = Rumah_sakit::all();
        $departemen = Departemen::all();

        return $this->moduleView('form', [
            'id' => $id,
            'default' => $default,
            'page_title' => FORM::title($id, MODULE_TITLE),
            'form_action' => $form_action,
            'user_type' => $user_type,
            'rumah_sakit' => $rumah_sakit,
            'departemen' => $departemen,
        ]);
    }

    public function add(): View
    {
        $this->moduleAllow('add');

        $default = [];

        return $this->_form(0, $default);
    }

    public function add_process(Request $request): RedirectResponse
    {
        $this->moduleAllow('add');

        $rules = [
            'username' => 'required|max:50|unique:users,username',
            'name' => 'required',
        ];
        $attributes = [
            'name' => 'Full Name',
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

        $name = $request->get('name');
        $username = $request->get('username');
        $password = $request->get('password');
        $type = $request->get('type');
        $rumah_sakit_id = $request->get('rumah_sakit_id');
        $departemen_id = $request->get('departemen_id');

        if ($type == UserType::NationalCoordinator) {
            $rumah_sakit_id = 0;
            $departemen_id = 0;
        } else {
            if ($type == UserType::RegionalCoordinator) {
            } else {
                $departemen_id = 0;
            }
        }

        $data = [
            'name' => $name,
            'username' => $username,
            'password' => Hash::make($password),
            'type' => $type,
            'rumah_sakit_id' => $rumah_sakit_id,
            'departemen_id' => $departemen_id,
            'email' => '',
        ];
        ModuleModel::insert($data);

        $this->flash_success_add();

        return redirect()->route(MODULE.'.index');
    }

    public function edit($id): View
    {
        $this->moduleAllow('edit');

        $default = ModuleModel::findOrFail($id);

        return $this->_form($id, $default);
    }

    public function edit_process(Request $request, $id): RedirectResponse
    {
        $this->moduleAllow('edit');

        $default = ModuleModel::findOrFail($id);

        $rules = [
            'username' => 'required|max:50|unique:users,username,'.$id,
            'name' => 'required',
        ];
        $attributes = [
            'name' => 'Full Name',
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

        $name = $request->get('name');
        $username = $request->get('username');
        $password = $request->get('password');
        $type = $request->get('type');
        $rumah_sakit_id = $request->get('rumah_sakit_id');
        $departemen_id = $request->get('departemen_id');

        if ($type == UserType::NationalCoordinator) {
            $rumah_sakit_id = 0;
            $departemen_id = 0;
        } else {
            if ($type == UserType::RegionalCoordinator) {
            } else {
                $departemen_id = 0;
            }
        }

        $data = [
            'name' => $name,
            'username' => $username,
            'password' => Hash::make($password),
            'type' => $type,
            'rumah_sakit_id' => $rumah_sakit_id,
            'departemen_id' => $departemen_id,
            'email' => '',
        ];
        if (trim($password) == '') unset($data['password']);

        $default = ModuleModel::findOrFail($id);
        $default->update($data);

        $this->flash_success_edit();

        return redirect()->route(MODULE.'.index');
    }
}
