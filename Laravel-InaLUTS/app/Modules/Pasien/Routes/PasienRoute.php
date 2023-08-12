<?php

// $module is taken from routes/web.php

$use_controller = App\Modules\Pasien\Controllers\PasienController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'add')->name('add');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::get('/{id}/detail', 'detail')->name('detail');

    $a = [
        'pilihan_penyakit',
    ];
    foreach($a as $v){
        Route::get('/{id}/detail_'.$v, 'detail_'.$v)
            ->name('detail_'.$v);
        Route::post('/{id}/update_'.$v, 'update_'.$v.'_process')
            ->name('update_'.$v);
    }

    $oab = [
        'anamnesis',
        'keluhan_tambahan',
        'faktor_resiko',
        'riwayat_pengobatan_1_bln',
        'riwayat_pengobatan_luts',
        'riwayat_operasi_urologi',
    ];
    foreach($oab as $v){
        Route::get('/{id}/detail_oab_'.$v, 'detail_oab_'.$v)
            ->name('detail_oab_'.$v);
        Route::post('/{id}/update_oab_'.$v, 'update_oab_'.$v.'_process')
            ->name('update_oab_'.$v);
    }

    Route::post('/add', 'add_process')->name('add');
    Route::post('/{id}/edit', 'edit_process')->name('edit');
    Route::post('/ajax_check_nik', 'post_ajax_check_nik')
        ->name('ajax_check_nik');
});
