<?php

// $module is taken from routes/web.php

$use_controller = App\Modules\Follow_up_v2\Controllers\Follow_up_v2Controller::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');

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
        //'kuesioner_qol',
        'kuesioner_ipss',
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
            Route::get('/{id}/{follow_up_id}/list_oab_'.$v, 'list_oab_'.$v)
                ->name('list_oab_'.$v);
            Route::get('/{id}/{follow_up_id}/add_oab_'.$v, 'add_oab_'.$v)
                ->name('add_oab_'.$v);

            Route::post('/{id}/{follow_up_id}/add_oab_'.$v, 'add_oab_'.$v.'_process')
                ->name('add_oab_'.$v);
        }
        if ($v == 'terapi_operatif') {
            Route::get('/{id}/{follow_up_id}/list_oab_'.$v.'_injeksi_botox', 'list_oab_'.$v.'_injeksi_botox')
                ->name('list_oab_'.$v.'_injeksi_botox');
            Route::get('/{id}/{follow_up_id}/add_oab_'.$v.'_injeksi_botox', 'add_oab_'.$v.'_injeksi_botox')
                ->name('add_oab_'.$v.'_injeksi_botox');
            Route::get('/{id}/{follow_up_id}/detail_oab_'.$v.'_injeksi_botox', 'detail_oab_'.$v.'_injeksi_botox')
                ->name('detail_oab_'.$v.'_injeksi_botox');

            Route::post('/{id}/{follow_up_id}/add_oab_'.$v.'_injeksi_botox', 'add_oab_'.$v.'_injeksi_botox_process')
                ->name('add_oab_'.$v.'_injeksi_botox');
            Route::post('/{id}/{follow_up_id}/update_oab_'.$v.'_injeksi_botox', 'update_oab_'.$v.'_injeksi_botox_process')
                ->name('update_oab_'.$v.'_injeksi_botox');
        }

        // {id} refers to {pasien_id}
        Route::get('/{id}/{follow_up_id}/detail_oab_'.$v, 'detail_oab_'.$v)
            ->name('detail_oab_'.$v);
        Route::post('/{id}/{follow_up_id}/update_oab_'.$v, 'update_oab_'.$v.'_process')
            ->name('update_oab_'.$v);
    }

    //Route::get('/add', 'add')->name('add');
    //Route::get('/{id}/edit', 'edit')->name('edit');
    //#v2#Route::get('/{pasien_id}/add', 'add')->name('add');
    //#v2#Route::get('/{pasien_id}/{id}/detail', 'detail')->name('detail');
    //#v2#Route::get('/{pasien_id}/{id}/edit', 'edit')->name('edit');

    //#v2#Route::post('/{pasien_id}/add', 'add_process')->name('add');
    //Route::post('/{id}/edit', 'edit_process')->name('edit');
    //#v2#Route::post('/search', 'search_process')->name('search');

    //#v2#Route::post('/{pasien_id}/{id}/edit', 'edit_process')
        //#v2#->name('edit');
    //#v2#Route::post('/{pasien_id}/{id}/update_oab', 'update_oab_process')
        //#v2#->name('update_oab');

    /*
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
    */

    /*
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
    */
});
