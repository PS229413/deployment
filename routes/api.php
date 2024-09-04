<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\Staff_Information;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SickController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderlineController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffRoleController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\SalaryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [StaffAuthController::class, 'login']);
Route::post('/logout', [StaffAuthController::class, 'logout']);
Route::post('/customer/register', [CustomerController::class, 'Register']);
Route::post('/customer/login', [CustomerController::class, 'login']);

Route::get('/staff', [StaffAuthController::class, 'index']);
Route::post('/staff/create', [StaffAuthController::class, 'store']);
Route::put('/staff/update/{id}', [StaffAuthController::class, 'update']);
Route::delete('/staff/{id}', [StaffAuthController::class, 'destroy']);

Route::post('/staff_information', [Staff_Information::class, 'store']);
Route::get('/staff_information', [Staff_Information::class, 'index']);
Route::put('/staff_information/update/{id}', [Staff_Information::class, 'update']);
Route::delete('/staff_information/{id}', [Staff_Information::class, 'destroy']);
Route::get('/staff_information/staff/{staffId}', [Staff_Information::class, 'getByStaffId']);
Route::get('/staff_information/{id}', [Staff_Information::class, 'getById']);

Route::get('/schedules', [ScheduleController::class, 'index']);
Route::get('staff/{staff_id}/schedules', [ScheduleController::class, 'getSchedulesByStaff']);
Route::post('/schedules/create', [ScheduleController::class, 'store']);
Route::put('/schedules/update/{id}', [ScheduleController::class, 'update']);
Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);

Route::get('/sicks', [SickController::class, 'index']);


Route::get('/staff/{id}', [StaffAuthController::class, 'show']);
Route::get('/staff_information/{id}', [Staff_Information::class, 'show']);
Route::get('/schedules/{id}', [ScheduleController::class, 'show']);
Route::get('/sicks/{id}', [SickController::class, 'show']);
Route::get('/sicks/by_staff/{staff_id}', [SickController::class, 'showByStaff']);
Route::post('/sicks/create', [SickController::class, 'store']);
Route::put('/sicks/update/{id}', [SickController::class, 'update']);
Route::delete('/sicks/{id}', [SickController::class, 'destroy']);

Route::get('/vacations', [VacationController::class, 'index']);
Route::get('/vacations/{id}', [VacationController::class, 'show']);
Route::get('/vacations/by_staff/{staff_id}', [VacationController::class, 'showByStaff']);
Route::post('/vacations', [VacationController::class, 'store']);
Route::put('/vacations/{id}', [VacationController::class, 'update']);
Route::delete('/vacations/{id}', [VacationController::class, 'destroy']);

Route::get('/salaries', [SalaryController::class, 'index']);
Route::post('/salaries', [SalaryController::class, 'store']);
Route::get('/salaries/{id}', [SalaryController::class, 'show']);
Route::put('/salaries/{id}', [SalaryController::class, 'update']);
Route::delete('/salaries/{id}', [SalaryController::class, 'destroy']);

// Additional routes
Route::get('salaries/{month}/{year}', [SalaryController::class, 'getSalariesByMonthYear']);
Route::get('salaries/by_staff/{staffId}', [SalaryController::class, 'getSalariesByStaffId']);

Route::get('products/get-first/{amount}', [ProductController::class, 'getFirst']);
Route::get('products/get-after-first/{amount}', [ProductController::class, 'getAfterFirst']);

Route::post('categories/{category}/products/{product}', [CategoryProductController::class, 'addCategoryProduct']);
Route::delete('categories/{category}/products/{product}', [CategoryProductController::class, 'removeCategoryProduct']);

Route::post('newsitems/{news_id}/images/{image_id}', [ImageNewsController::class, 'addImgToItem']);
Route::delete('newsitems/{news_id}/images/{image_id}', [ImageNewsController::class, 'removeImgFromItem']);

Route::post('staff/{staff_id}/role/{role_id}', [StaffRoleController::class, 'addRoleToStaff']);
Route::delete('staff/{staff_id}/role/{role_id}', [StaffRoleController::class, 'removeRoleFromStaff']);

Route::get('products/search', [ProductController::class, 'getProductsByInput']);
Route::put('products/{id}/changemargin', [ProductController::class, 'changeMargin']);
Route::put('products/{id}/changediscount', [ProductController::class, 'changeDiscount']);
Route::put('products/changestock', [ProductController::class, 'changeStock']);

Route::get('orders/{id}', [OrderController::class, 'show']);
Route::put('orders/{id}/complete', [OrderlineController::class, 'completeOrder']);

Route::get('products/id', [ProductController::class, 'getAllIds']);

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('news', NewsController::class);
Route::apiResource('roles', RoleController::class);

Route::post('/rolececk', [AuthController::class, 'rolececk']);
