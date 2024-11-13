<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\ProgramController;
use App\Http\Controllers\Backend\LevelController;
use App\Http\Controllers\Backend\LessonController;

Route::group(['prefix' => 'admin'], function() {

    Route::get('/', function () {
        if (auth('admin')->check()) {
            return redirect()->route('admin.dashboard'); // Redirect to dashboard if authenticated
        } else {
            return redirect()->route('admin.login'); // Redirect to login if not authenticated
        }
    });
    
    // for authenticated admin
    Route::group(['middleware' => ['auth:admin']], function () {  
     
        // admin profile
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // Admin
        Route::post('/adminUser/restore/{id}', [AdminsController::class, 'restore']);
        Route::get('/adminUser/trash', [AdminsController::class, 'getSoftDeleted'])->name('admin-user.trash');
        Route::delete('/adminUser/remove/{id}', [AdminsController::class, 'permanentDelete']);

        // Program
        Route::get('/program/trash', [ProgramController::class, 'getSoftDeleted'])->name('program.trash');
        Route::post('/program/restore/{id}', [ProgramController::class, 'restore']);
        Route::delete('/program/remove/{id}', [ProgramController::class, 'permanentDelete']);

        // Level
        Route::get('/level/trash', [LevelController::class, 'getSoftDeleted'])->name('level.trash');
        Route::post('/level/restore/{id}', [LevelController::class, 'restore']);
        Route::delete('/level/remove/{id}', [LevelController::class, 'permanentDelete']);

        //lesson
        Route::get('/lesson/trash', [LessonController::class, 'getSoftDeleted'])->name('lesson.trash');
        Route::post('/lesson/restore/{id}', [LessonController::class, 'restore']);
        Route::delete('/lesson/remove/{id}', [LessonController::class, 'permanentDelete']);


        // resource routes
        Route::resources([
            'admin-user'        => AdminsController::class,
            'program'           => ProgramController::class,
            'level'             => LevelController::class,
            'lesson'            => LessonController::class,
        ]); 
    });
    

    // for guests
    Route::group(['middleware' => ['guest:admin']], function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    
        Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
        Route::post('/register', [AdminAuthController::class, 'register']);
    });
    
});



