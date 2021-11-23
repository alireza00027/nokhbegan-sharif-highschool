<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\FinancialItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::prefix('exams')->group(function () {
        Route::get('/', [ExamController::class, 'index'])->name('exams.index');
        Route::get('chart-style', [ExamController::class, 'chartStyle'])->name('exams.chartStyle');
    });

    Route::prefix('financials')->group(function () {
        Route::get('/', [FinancialController::class, 'index'])->name('financials.index');
        Route::get('/{financial}/show', [FinancialController::class, 'show'])->name('financials.show');
    });

    Route::prefix('financialItems')->group(function () {
        Route::get('/{financialItem}/payment', [FinancialItemController::class, 'payment'])->name('financialItems.payment');
        Route::get('/payment/check', [FinancialItemController::class, 'check'])->name('financialItems.payment.check');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::get('/{schedule}/show', [ScheduleController::class, 'show'])->name('schedules.show');
        Route::patch('/{schedule}/process', [ScheduleController::class, 'process'])->name('schedules.process');
    });
});

require __DIR__ . '/auth.php';
