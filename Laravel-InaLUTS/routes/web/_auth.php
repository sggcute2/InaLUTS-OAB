<?php

$use_controller = App\Modules\Auth\Controllers\AuthController::class;

Route::controller($use_controller)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('login');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});
