<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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
        define('IS_DETAIL_PATIENT', false);
        define('IS_USER_TYPE_1', false);
        define('IS_USER_TYPE_3', false);
        define('USER_HOSPITAL_ID', 0);
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
    public function flash_success_add(){
        Session::flash('success',
        Lang::get('message.success_add', ['title' => MODULE_TITLE ?? ''])
        );
    }

    # Flash for Success Edit
    public function flash_success_edit(){
        Session::flash('success',
        Lang::get('message.success_edit', ['title' => MODULE_TITLE ?? ''])
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
}
