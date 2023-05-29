
<?php

use App\Http\Controllers\ApiUploadXmlController;
use Illuminate\Support\Facades\Route;

Route::middleware('is_cliente_api')->controller(ApiUploadXmlController::class)->group(function () {
    Route::post('/uploadxml', 'cadastroXML');
});

