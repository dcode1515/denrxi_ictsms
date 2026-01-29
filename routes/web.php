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
Route::get('/request/access', [App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('/api/post/login', [App\Http\Controllers\Auth\AuthController::class, 'post_login']);
Route::get('/api/head-offices', [App\Http\Controllers\Auth\AuthController::class, 'headOffices']);
Route::get('/api/offices/{headOfficeId}', [App\Http\Controllers\Auth\AuthController::class, 'officesByHeadOffice']);
Route::post('/api/post/register', [App\Http\Controllers\Auth\AuthController::class, 'register_user']);



/*End Auth Routes*/


/*Ticket Routes*/
Route::get('/ticket/request', [App\Http\Controllers\TicketController::class, 'ticket'])->name('ticket.request');
Route::get('/api/ticket/type', [App\Http\Controllers\TicketController::class, 'TicketType']);
Route::get('/api/ticket/categories/{tickettypeID}', [App\Http\Controllers\TicketController::class, 'categoriesByTicketType']);
Route::get('/api/ticket/head-offices', [App\Http\Controllers\TicketController::class, 'headOffices']);
Route::get('/api/ticket/offices/{headOfficeId}', [App\Http\Controllers\TicketController::class, 'officesByHeadOffice']);
Route::post('/api/store/request/ticket', [App\Http\Controllers\TicketController::class, 'store_ticket']);
Route::get('/ticket-success/{id}', [App\Http\Controllers\TicketController::class, 'ticket_success']);


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
Route::delete('/api/delete/office/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_office']);
Route::get('/ticket/type', [App\Http\Controllers\Admin\AdminController::class, 'ticket_type'])->name('ticket.type');
Route::get('/ticket/category', [App\Http\Controllers\Admin\AdminController::class, 'ticket_category'])->name('ticket.category');
Route::post('/api/store/ticket/type', [App\Http\Controllers\Admin\AdminController::class, 'store_ticket_type']);
Route::get('/api/get/data/ticket/type', [App\Http\Controllers\Admin\AdminController::class, 'getDataTicketType']);
Route::post('/api/update/ticket/type/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_ticket_type']);
Route::delete('/api/delete/ticket/type/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_ticket_type']);
Route::get('/user/management', [App\Http\Controllers\Admin\AdminController::class, 'user_management'])->name('user.management');
Route::get('/api/get/data/user/pending', [App\Http\Controllers\Admin\AdminController::class, 'getDataUserPending']);
Route::get('/api/get/data/module', [App\Http\Controllers\Admin\AdminController::class, 'getModuleAssign']);
Route::put('/api/update/user/account/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_user_account']);
Route::get('/api/get/data/type', [App\Http\Controllers\Admin\AdminController::class, 'getTicketType']);
Route::post('/api/store/ticket/category', [App\Http\Controllers\Admin\AdminController::class, 'store_ticket_category']);
Route::get('/api/get/data/ticket/category', [App\Http\Controllers\Admin\AdminController::class, 'getDataTicketCategory']);
Route::put('/api/update/ticket/category/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_ticket_category']);
Route::delete('/api/delete/ticket/category/{id}', [App\Http\Controllers\Admin\AdminController::class, 'delete_ticket_category']);
/*End Admin Routes*/




/*Technician  Routes*/
Route::get('/helpdesk/dashboard', [App\Http\Controllers\Helpdesk\HelpdeskController::class, 'helpdesk'])->name('helpdesk.dashboard');
Route::get('/profile/{id}', [App\Http\Controllers\Auth\AuthController::class, 'showProfile'])->name('profile.show');
Route::get('/profile/{id}', [App\Http\Controllers\Auth\AuthController::class, 'showProfile'])->name('profile.show');
Route::post('/api/update/profile/{id}', [App\Http\Controllers\Auth\AuthController::class, 'update_profile']);
Route::post('/api/update/user/credential/{id}', [App\Http\Controllers\Auth\AuthController::class, 'update_user_credentials']);
Route::get('/ticket', [App\Http\Controllers\Helpdesk\HelpdeskController::class, 'ticket'])->name('ticket');
Route::get('/api/get/all/ticket/request', [App\Http\Controllers\Helpdesk\HelpdeskController::class, 'getDataAllRequest']);
Route::post('/api/get/data/receive/{id}', [App\Http\Controllers\Helpdesk\HelpdeskController::class, 'receive_tickets']);
Route::post('/api/get/update/ticket/request/{id}', [App\Http\Controllers\Helpdesk\HelpdeskController::class, 'update_status_tickets']);
Route::get('/api/get/all/resolved/ticket', [App\Http\Controllers\Helpdesk\HelpdeskController::class, 'getDataAllResolvedTicket']);



/*End Technician  Routes*/