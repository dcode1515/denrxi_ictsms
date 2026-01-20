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

/*Auth Routes*/
Route::get('/', [App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
Route::post('/api/post/login', [App\Http\Controllers\Auth\AuthController::class, 'post_login']);
/*End Auth Routes*/


/*Ticket Routes*/
Route::get('/ticket/request', [App\Http\Controllers\HelpdeskController::class, 'ticket']);
/*End Ticket Routes*/


/*Admin  Routes*/
Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/head/office', [App\Http\Controllers\Admin\AdminController::class, 'head_office'])->name('head.office');
/*End Admin Routes*/