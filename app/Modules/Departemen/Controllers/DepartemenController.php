<?php

namespace App\Modules\Departemen\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Departemen\Models\Departemen as ModuleModel;
use BS;
use DT;
use FORM;

class DepartemenController extends Controller
{
    public function __construct(){
        parent::__construct([
            'module' => 'departemen',
            'title' => 'Departemen',
        ]);
    }

    public function index(): View
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

    private function _form($id = 0, $default = []): View
    {
        //dd($default);

        $form_action = ($id)
            ? route(MODULE.'.edit', $id)
            : route(MODULE.'.add');

        return $this->moduleView('form', [
            'id' => $id,
            'default' => $default,
            'page_title' => FORM::title($id, MODULE_TITLE),
            'form_action' => $form_action,
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

        ModuleModel::base_insert($request->all());

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

        ModuleModel::base_update_by_id($request->all(), $id);

        $this->flash_success_edit();

        return redirect()->route(MODULE.'.index');
    }
}
