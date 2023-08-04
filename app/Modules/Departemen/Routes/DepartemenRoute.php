<?php

// $module is taken from routes/web.php

$use_controller =
    App\Modules\Departemen\Controllers\DepartemenController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::get('/{id}/edit', 'edit')->name('edit');

    Route::post('/add', 'add_process')->name('add');
    Route::post('/{id}/edit', 'edit_process')->name('edit');
});
