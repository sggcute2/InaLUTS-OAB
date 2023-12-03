<?php

// $module is taken from routes/web.php

$use_controller = App\Modules\Laporan_follow_up\Controllers\Laporan_follow_upController::class;
$m = $module;

Route::name($m.'.')->prefix($m)->controller($use_controller)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/Overactive_Bladder', 'Overactive_Bladder')
        ->name('Overactive_Bladder');

    Route::post('/Overactive_Bladder', 'Overactive_Bladder_process')
        ->name('Overactive_Bladder');
});
