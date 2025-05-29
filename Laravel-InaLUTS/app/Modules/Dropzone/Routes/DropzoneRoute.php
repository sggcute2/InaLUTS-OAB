<?php

// $module is taken from routes/web.php

$use_controller =
    App\Modules\Dropzone\Controllers\DropzoneController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    //Route::get('/', 'index')->name('index');
    //Route::get('/add', 'add')->name('add');
    Route::get('/{id}/{token}/{use_model}/download', 'download')->name('download');

    Route::post('/store', 'store')->name('store');
    //Route::post('/{id}/edit', 'edit_process')->name('edit');
});
