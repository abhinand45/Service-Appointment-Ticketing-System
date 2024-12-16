<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ServiceTicketApiController;

Route::prefix('service-tickets')->group(function () {
    Route::post('/', [ServiceTicketApiController::class, 'store']);
    Route::get('/', [ServiceTicketApiController::class, 'index']);
    Route::get('/{id}', [ServiceTicketApiController::class, 'show']);
    Route::put('/{id}', [ServiceTicketApiController::class, 'update']);
    Route::delete('/{id}', [ServiceTicketApiController::class, 'destroy']);
});
