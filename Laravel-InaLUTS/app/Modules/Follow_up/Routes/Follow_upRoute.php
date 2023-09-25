<?php

// $module is taken from routes/web.php

$use_controller = App\Modules\Follow_up\Controllers\Follow_upController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');
    //Route::get('/add', 'add')->name('add');
    //Route::get('/{id}/edit', 'edit')->name('edit');
    Route::get('/{pasien_id}/add', 'add')->name('add');
    Route::get('/{pasien_id}/{id}/detail', 'detail')->name('detail');

    Route::post('/{pasien_id}/add', 'add_process')->name('add');
    //Route::post('/{id}/edit', 'edit_process')->name('edit');
    Route::post('/search', 'search_process')->name('search');

    Route::post('/{pasien_id}/{id}/update_oab', 'update_oab_process')
        ->name('update_oab');
});
