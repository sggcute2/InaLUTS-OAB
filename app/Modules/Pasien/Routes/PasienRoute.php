<?php

// $module is taken from routes/web.php

$use_controller = App\Modules\Pasien\Controllers\PasienController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::get('/{id}/edit', 'edit')->name('edit');

    Route::post('/add', 'add_process')->name('add');
    Route::post('/{id}/edit', 'edit_process')->name('edit');
    Route::post('/ajax_check_nik', 'post_ajax_check_nik')
        ->name('ajax_check_nik');
});
