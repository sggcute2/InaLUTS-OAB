<?php

// $module is taken from routes/web.php

$use_controller = App\Modules\Kota\Controllers\KotaController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');
});
