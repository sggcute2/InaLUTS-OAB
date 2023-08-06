<?php

namespace App\Modules\Profile\Controllers;

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

class ProfileController extends Controller
{
    public function __construct(){
        parent::__construct([
            'module' => 'profile',
            'title' => 'Profile',
        ]);
    }

    public function index(): View
    {
        return $this->edit(USER_ID);
    }

    private function _form($id = 0, $default = []): View
    {
        $old = session()->getOldInput();
        if ($old) $default = $old;

        //dd($default);

        $form_action = route(MODULE.'.edit', $id);

        $user_type = UserType::all_except_admin();
        //dd($user_type);

        $rumah_sakit = Rumah_sakit::all();
        $departemen = Departemen::all();

        return $this->moduleView('form', [
            'id' => $id,
            'default' => $default,
            'page_title' => MODULE_TITLE,
            'form_action' => $form_action,
            'user_type' => $user_type,
            'rumah_sakit' => $rumah_sakit,
            'departemen' => $departemen,
        ]);
    }

    public function add(): View
    {
        $this->moduleAllow('add');
        abort(403);
    }

    public function add_process(Request $request): RedirectResponse
    {
        $this->moduleAllow('add');
        abort(403);
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
        $password = $request->get('password');

        $data = [
            'name' => $name,
            'password' => Hash::make($password),
            'email' => '',
        ];
        if (trim($password) == '') unset($data['password']);

        $default = ModuleModel::findOrFail($id);
        $default->update($data);

        $this->flash_success_update();

        return redirect()->route(MODULE.'.index');
    }
}
