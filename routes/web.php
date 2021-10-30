<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*
 * Admin Area
 */
Route::prefix('admin')->name('admin.')->group(function (){
    require __DIR__.'/admin_auth.php';
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function (){
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/roles', \App\Http\Controllers\Backend\RoleController::class);
    Route::resource('/users', \App\Http\Controllers\Backend\UserController::class);
    Route::resource('/admins', \App\Http\Controllers\Backend\AdminController::class);
});
