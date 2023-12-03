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
    Route::get('/{pasien_id}/{id}/edit', 'edit')->name('edit');

    Route::post('/{pasien_id}/add', 'add_process')->name('add');
    //Route::post('/{id}/edit', 'edit_process')->name('edit');
    Route::post('/search', 'search_process')->name('search');

    Route::post('/{pasien_id}/{id}/edit', 'edit_process')
        ->name('edit');
    Route::post('/{pasien_id}/{id}/update_oab', 'update_oab_process')
        ->name('update_oab');

    $v = 'pemeriksaan_laboratorium';
    if ($v == 'pemeriksaan_laboratorium') {
        Route::get('/{pasien_id}/{id}/list_oab_'.$v, 'list_oab_'.$v)
            ->name('list_oab_'.$v);
        Route::get('/{pasien_id}/{id}/add_oab_'.$v, 'add_oab_'.$v)
            ->name('add_oab_'.$v);
        Route::get('/{pasien_id}/{id}/detail_oab_'.$v, 'detail_oab_'.$v)
            ->name('detail_oab_'.$v);

        Route::post('/{pasien_id}/{id}/add_oab_'.$v, 'add_oab_'.$v.'_process')
            ->name('add_oab_'.$v);
        Route::post('/{pasien_id}/{id}/update_oab_'.$v, 'update_oab_'.$v.'_process')
            ->name('update_oab_'.$v);
    }

    $v = 'terapi_operatif';
    if ($v == 'terapi_operatif') {
        Route::get('/{pasien_id}/{id}/list_oab_'.$v.'_injeksi_botox', 'list_oab_'.$v.'_injeksi_botox')
            ->name('list_oab_'.$v.'_injeksi_botox');
        Route::get('/{pasien_id}/{id}/add_oab_'.$v.'_injeksi_botox', 'add_oab_'.$v.'_injeksi_botox')
            ->name('add_oab_'.$v.'_injeksi_botox');
        Route::get('/{pasien_id}/{id}/detail_oab_'.$v.'_injeksi_botox', 'detail_oab_'.$v.'_injeksi_botox')
            ->name('detail_oab_'.$v.'_injeksi_botox');

        Route::post('/{pasien_id}/{id}/add_oab_'.$v.'_injeksi_botox', 'add_oab_'.$v.'_injeksi_botox_process')
            ->name('add_oab_'.$v.'_injeksi_botox');
        Route::post('/{pasien_id}/{id}/update_oab_'.$v.'_injeksi_botox', 'update_oab_'.$v.'_injeksi_botox_process')
            ->name('update_oab_'.$v.'_injeksi_botox');
    }
});
