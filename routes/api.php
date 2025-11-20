<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpanceController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkerSalaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function(){
    Route::get('/menu' , [MenuController::class , 'menu']);
});

Route::prefix('products')->group(function () {
    Route::get('list', [ProductController::class, 'index']);
    Route::post('create', [ProductController::class, 'create']);
    Route::put('update/{id}', [ProductController::class, 'update']);
    Route::delete('delete/{id}', [ProductController::class, 'delete']);
    Route::get('export' , [ProductController::class , 'export']);
});

Route::prefix('users')->group(function () {
    Route::get('list', [UserController::class, 'index']);
    Route::post('create', [UserController::class, 'create']);
    Route::put('update/{id}', [UserController::class, 'update']);
    Route::delete('delete/{id}', [UserController::class, 'delete']);
    Route::get('export' , [UserController::class , 'export']);
});

Route::prefix('permissions')->group(function () {
    Route::get('list', [PermissionController::class, 'index']);
    Route::post('create', [PermissionController::class, 'create']);
    Route::put('update/{id}', [PermissionController::class, 'update']);
    Route::delete('delete/{id}', [PermissionController::class, 'delete']);
});

Route::prefix('roles')->group(function () {
    Route::get('list', [RolesController::class, 'index']);
    Route::post('create', [RolesController::class, 'create']);
    Route::put('update/{id}', [RolesController::class, 'update']);
    Route::delete('delete/{id}', [RolesController::class, 'delete']);
    Route::get('export' , [RolesController::class , 'export']);
});

Route::prefix('material_types')->group(function () {
    Route::get('list', [MaterialTypeController::class, 'index']);
    Route::post('create', [MaterialTypeController::class, 'create']);
    Route::put('update/{id}', [MaterialTypeController::class, 'update']);
    Route::delete('delete/{id}', [MaterialTypeController::class, 'delete']);
    Route::post('search' , [MaterialTypeController::class , 'search']);
});

Route::prefix('materials')->group(function () {
    Route::get('list', [MaterialController::class, 'index']);
    Route::post('create', [MaterialController::class, 'create']);
    Route::put('update/{id}', [MaterialController::class, 'update']);
    Route::delete('delete/{id}', [MaterialController::class, 'delete']);
    Route::get('export' , [MaterialController::class , 'export']);
});

Route::prefix('companies')->group(function () {
    Route::get('list', [CompanyController::class, 'index']);
    Route::post('create', [CompanyController::class, 'create']);
    Route::put('update/{id}', [CompanyController::class, 'update']);
    Route::delete('delete/{id}', [CompanyController::class, 'delete']);
    Route::get('export' , [CompanyController::class , 'export']);
    Route::get('show/{id}' , [CompanyController::class , 'show']);
    Route::get('overall-debt/{id}' , [CompanyController::class , 'getCompanyDebt']);
});

Route::prefix('sales')->group(function () {
    Route::get('list', [SaleController::class, 'index']);
    Route::post('create', [SaleController::class, 'create']);
    Route::get('export' , [SaleController::class , 'export']);
});

Route::prefix('payments')->group(function () {
    Route::get('list', [PaymentController::class, 'index']);
    Route::post('create', [PaymentController::class, 'create']);
    Route::put('update/{id}' , [PaymentController::class , 'update']);
});

Route::prefix('expances')->group(function () {
    Route::get('list', [ExpanceController::class, 'index']);
    Route::post('create', [ExpanceController::class, 'create']);
    Route::post('search' , [ExpanceController::class , 'search']);
    Route::get('export' , [ExpanceController::class , 'export']);
    Route::get('calculate-expances' , [ExpanceController::class , 'calculateExpances']);
});

Route::prefix('actions')->group( function(){
    Route::get('list' , [ActionController::class, 'list']);
});

Route::prefix('dashboard')->group( function (){
    Route::post('get-sale-by-day' , [DashboardController::class , 'getSaleByDay']);
    Route::post('get-sale-by-month' , [DashboardController::class , 'getSaleByMonth']);
});

Route::prefix('workers')->group(function(){
    Route::get('list' , [WorkerController::class , 'list']);
    Route::post('create' , [WorkerController::class , 'create']);
    Route::put('update/{id}' , [WorkerController::class , 'update']);
    Route::delete('delete/{id}' , [WorkerController::class , 'delete']);
    Route::get('get/{id}' , [WorkerController::class , 'get']);
});

Route::prefix('salaries')->group(function(){
    Route::get('list' , [WorkerSalaryController::class , 'list']);
    Route::post('create' , [WorkerSalaryController::class , 'create']);
});
