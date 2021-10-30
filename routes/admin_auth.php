<?php

use App\Http\Controllers\Backend\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Backend\Auth\NewPasswordController;
use App\Http\Controllers\Backend\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->name('login.submit');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
