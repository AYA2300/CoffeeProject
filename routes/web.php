<?php

use App\Http\Controllers\Dashboard\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard/login', [AdminController::class, 'showLoginForm'])->name('dashboard.login');
Route::post('/dashboard/login', [AdminController::class, 'login'])->name('dashboard.login.submit');

Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('auth:web');
