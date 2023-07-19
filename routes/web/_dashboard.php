<?php

// $module is taken from ../web.php

$use_controller = App\Modules\Dashboard\Controllers\DashboardController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');
});
