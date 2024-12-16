<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\ServiceTicketController;

Route::get('service-tickets', [ServiceTicketController::class, 'index'])->name('service-tickets.index');
Route::get('service-tickets/create', [ServiceTicketController::class, 'create'])->name('service-tickets.create');
Route::post('service-tickets', [ServiceTicketController::class, 'store'])->name('service-tickets.store');
Route::patch('service-tickets/{id}/status', [ServiceTicketController::class, 'updateStatus'])->name('service-tickets.updateStatus');


// API configuaration

// Route::get('service-tickets', [ServiceTicketController::class, 'index']);
// Route::post('service-tickets', [ServiceTicketController::class, 'store']);

