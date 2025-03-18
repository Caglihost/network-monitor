<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScanResultController;

// Route de la liste principale
Route::get('/scan-results', [ScanResultController::class, 'index'])->name('scan_results.index');

// Route de la page détail
Route::get('/scan-results/{id}', [ScanResultController::class, 'show'])->name('scan_results.show');

Route::get('/scan-results/host/{hostname}', [ScanResultController::class, 'showByHostname'])
     ->name('scan_results.showByHostname');
     
Route::get('/', function () {
    return view('welcome');
});
