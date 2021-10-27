<?php

use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\FinancialController;
use App\Http\Controllers\Admin\FinancialItemController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Financial;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'isAdmin'])->group(function () {
    //user Routing
    Route::get('teachers',[UserController::class,'teachers'])->middleware('can:managerOrAssistant')->name('teachers.index');
    Route::prefix('students')->middleware('can:managerOrAssistant')->group(function () {
        Route::get('/seventh',[UserController::class,'seventhList'])->name('students.seventhList');
        Route::get('/eighth',[UserController::class,'eighthList'])->name('students.eighthList');
        Route::get('/ninth',[UserController::class,'ninthList'])->name('students.ninthList');
        Route::get('/edit/{user}',[UserController::class,'edit'])->name('students.edit');
        Route::patch('{user}/update',[UserController::class,'update'])->name('students.update');
        Route::delete('{user}/delete', [UserController::class,'delete'])->name('students.delete');
    });

    //course Routing

    Route::prefix('courses')->middleware('can:managerOrAssistant')->group(function () {
        Route::get('/',[CourseController::class,'index'])->name('courses.index');
        Route::post('/store',[CourseController::class,'store'])->name('courses.store');
        Route::patch('/{course}/update',[CourseController::class,'update'])->name('courses.update');
        Route::delete('{course}/delete', [CourseController::class,'delete'])->name('courses.delete');
    });

    Route::prefix('exams')->middleware('can:managerOrAssistantOrteacher')->group(function () {
        Route::get('create',[ExamController::class,'create'])->name('exams.create');
        Route::post('store',[ExamController::class,'store'])->name('exams.store');
        Route::get('/',[ExamController::class,'index'])->name('exams.index');
        Route::get('/chart-style',[ExamController::class,'chartStyle'])->name('exams.chartStyle');
    });
//adminLevel Routing
    Route::prefix('level')->middleware('can:manager')->group(function () {
        Route::get('/',[AdminLevelController::class,'index'])->name('level.index');
        Route::post('/store',[AdminLevelController::class,'store'])->name('level.store');
        Route::delete('{user}/delete',[AdminLevelController::class,'delete'])->name('level.delete');
    });
//financial Routing
    Route::prefix('financilas')->middleware('can:manager')->group(function() {
        Route::get('/create',[FinancialController::class,'create'])->name('financials.create');
        Route::post('/store',[FinancialController::class,'store'])->name('financials.store');
        Route::get('/',[FinancialController::class,'index'])->name('financials.index');
        Route::get('/{financial}/show',[FinancialController::class,'show'])->name('financials.show');
    });
});