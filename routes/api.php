<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employees', 'all');
    Route::post('/employees', 'create');
    Route::put('/employees/{id}', 'update');
    Route::delete('/employees/{id}', 'delete');
});

Route::controller(ContractController::class)->group(function () {
    Route::get('/contracts', 'all');
    Route::post('/contracts', 'create');
    Route::put('/contracts/{id}', 'update');
});

Route::controller(CertificateController::class)->group(function () {
    Route::get('/certifications/{id}', 'find');
    Route::post('/certifications', 'create');
});
