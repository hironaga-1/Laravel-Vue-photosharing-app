<?php

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

Route::get('/{any?}', fn() => view('index'))->where('any', '.+');

Auth::routes();

Route::get('/photos/{photo}/download', [App\Http\Controllers\PhotoController::class, 'download']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
