<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

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

        define('ACTION', '');
        define('IS_DETAIL_PATIENT', false);
        define('IS_USER_TYPE_1', false);
        define('IS_USER_TYPE_3', false);
        define('USER_HOSPITAL_ID', 0);
    }

    public function moduleView($view = '', $data = [])
    {
        return View::make(MODULE . '::' . $view, $data);
    }
}
