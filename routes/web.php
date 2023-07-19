<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

//require_once('web/auth.php');
$m = 'Auth';
require_once(
  app_path('/Modules/' . $m . '/Routes/' . $m . 'Route.php')
);

$modules = [
  'dashboard',
];
Route::group(['middleware' => ['auth']], function () use ($modules) {
    foreach($modules as $module)
    {
        $m = ucfirst($module);

        require_once(
            app_path('/Modules/' . $m . '/Routes/' . $m . 'Route.php')
        );
    }
});
