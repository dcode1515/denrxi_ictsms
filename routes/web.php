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
Route::post('/api/store/office/head', [App\Http\Controllers\Admin\AdminController::class, 'store_office_head']);
Route::get('/api/get/data/office/head', [App\Http\Controllers\Admin\AdminController::class, 'get_data_office_head']);
Route::post('/api/update/office/head/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_office_head']);
Route::delete('/api/delete/office/head/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_office_head']);
Route::get('/office', [App\Http\Controllers\Admin\AdminController::class, 'office'])->name('office');
Route::get('/api/get/office/head', [App\Http\Controllers\Admin\AdminController::class, 'getOfficeHead']);
Route::post('/api/store/office', [App\Http\Controllers\Admin\AdminController::class, 'store_office']);
Route::get('/api/get/data/office', [App\Http\Controllers\Admin\AdminController::class, 'getDataOffice']);
Route::post('/api/update/office/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_office']);


/*End Admin Routes*/