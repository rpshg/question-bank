<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminsController;

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
        // resource routes
        Route::resources([
            'admin-user' => AdminsController::class,
        ]); 


        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // Admin
        Route::post('/adminUser/restore/{id}', [AdminsController::class, 'restore']);
        Route::get('/adminUser/trash', [AdminsController::class, 'getSoftDeleted'])->name('admin-user.trash');
        Route::delete('/adminUser/remove/{id}', [AdminsController::class, 'permanentDelete']);

    });
    

    // for guests
    Route::group(['middleware' => ['guest:admin']], function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    
        Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
        Route::post('/register', [AdminAuthController::class, 'register']);
    });
    
});



