<?php

use App\Http\Controllers\AdmController;
use App\Http\Controllers\AdmLoginController;

use Illuminate\Support\Facades\Route;

Route::middleware('is_adm_visitante')->controller(AdmLoginController::class)->prefix('adm')->group(function () {
    Route::get('/login', 'login')->name('adm-login');
    Route::get('/', 'login')->name('adm-login');
    Route::post('/login', 'loginIn')->name('adm-login-post');
});

Route::middleware('is_adm_visitante')->controller(AdmLoginController::class)->group(function () {
    Route::get('/login', 'login')->name('adm-login');
    Route::get('/', 'login')->name('adm-login');
    Route::post('/login', 'loginIn')->name('adm-login-post');
});


Route::middleware('is_adm')->controller(AdmLoginController::class)->prefix('adm')->group(function () {
    Route::post('/logout', 'logout')->name('adm-logout');
});
//

Route::middleware('is_adm')->controller(AdmController::class)->prefix('adm')->group(function () {
    Route::get('/busca', 'getCliente')->name('adm-busca-cliente-lista');
    Route::get('/busca-cliente','getClienteByCampo')->name('adm-busca-cliente');
    Route::get('/busca-files/{busca}', 'getFiles')->name('adm-busca-cliente-files');
    Route::get('/dowload/{busca}', 'dowloadFiles')->name('adm-busca-cliente-files-download');

});


