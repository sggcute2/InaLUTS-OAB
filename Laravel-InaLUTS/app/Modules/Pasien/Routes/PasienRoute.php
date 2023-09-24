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
        'riwayat_operasi_non_urologi',
        'riwayat_radiasi',
        'sistem_skor',
        'kuesioner_oabss',
        'kuesioner_qol',
        'kuesioner_fsfi',
        'kuesioner_iief',
        'kuesioner_ehs',
        'kuesioner_bladder_diary',
        'pemeriksaan_fisik',
        'pemeriksaan_laboratorium',
        'penunjang_uroflowmetri',
        'penunjang_urodinamik',
        'pemeriksaan_imaging',
        'diagnosis',
        'penunjang',
        'terapi',
        'terapi_modifikasi_gaya_hidup',
        'terapi_rehabilitasi',
        'terapi_non_operatif',
        'terapi_medikamentosa',
        'terapi_operatif',
    ];
    foreach($oab as $v){
        if ($v == 'pemeriksaan_laboratorium') {
            Route::get('/{id}/list_oab_'.$v, 'list_oab_'.$v)
                ->name('list_oab_'.$v);
            Route::get('/{id}/add_oab_'.$v, 'add_oab_'.$v)
                ->name('add_oab_'.$v);

            Route::post('/{id}/add_oab_'.$v, 'add_oab_'.$v.'_process')
                ->name('add_oab_'.$v);
        }
        if ($v == 'terapi_operatif') {
            Route::get('/{id}/list_oab_'.$v.'_injeksi_botox', 'list_oab_'.$v.'_injeksi_botox')
                ->name('list_oab_'.$v.'_injeksi_botox');
            Route::get('/{id}/add_oab_'.$v.'_injeksi_botox', 'add_oab_'.$v.'_injeksi_botox')
                ->name('add_oab_'.$v.'_injeksi_botox');
            Route::get('/{id}/detail_oab_'.$v.'_injeksi_botox', 'detail_oab_'.$v.'_injeksi_botox')
                ->name('detail_oab_'.$v.'_injeksi_botox');

            Route::post('/{id}/add_oab_'.$v.'_injeksi_botox', 'add_oab_'.$v.'_injeksi_botox_process')
                ->name('add_oab_'.$v.'_injeksi_botox');
            Route::post('/{id}/update_oab_'.$v.'_injeksi_botox', 'update_oab_'.$v.'_injeksi_botox_process')
                ->name('update_oab_'.$v.'_injeksi_botox');
        }
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
