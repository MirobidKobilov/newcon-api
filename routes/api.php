<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExpanceController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('products')->group(function () {
    Route::get('list', [ProductController::class, 'index'])->middleware('permission:list_product');
    Route::post('create', [ProductController::class, 'create'])->middleware('permission:create_product');
    Route::put('update/{id}', [ProductController::class, 'update'])->middleware('permission:update_product');
    Route::delete('delete/{id}', [ProductController::class, 'delete'])->middleware('permission:delete_product');
});

Route::middleware('auth:sanctum')->prefix('users')->group(function () {
    Route::get('list', [UserController::class, 'index'])->middleware('permission:list_user');
    Route::post('create', [UserController::class, 'create'])->middleware('permission:create_user');
    Route::put('update/{id}', [UserController::class, 'update'])->middleware('permission:update_user');
    Route::delete('delete/{id}', [UserController::class, 'delete'])->middleware('permission:delete_user');
});

Route::middleware('auth:sanctum')->prefix('permissions')->group(function () {
    Route::get('list', [PermissionController::class, 'index'])->middleware('permission:list_permission');
    Route::post('create', [PermissionController::class, 'create'])->middleware('permission:create_permission');
    Route::put('update/{id}', [PermissionController::class, 'update'])->middleware('permission:update_permission');
    Route::delete('delete/{id}', [PermissionController::class, 'delete'])->middleware('permission:delete_permission');
});

Route::middleware('auth:sanctum')->prefix('roles')->group(function () {
    Route::get('list', [RolesController::class, 'index'])->middleware('permission:list_role');
    Route::post('create', [RolesController::class, 'create'])->middleware('permission:create_role');
    Route::put('update/{id}', [RolesController::class, 'update'])->middleware('permission:update_role');
    Route::delete('delete/{id}', [RolesController::class, 'delete'])->middleware('permission:delete_role');
});

Route::middleware('auth:sanctum')->prefix('material_types')->group(function () {
    Route::get('list', [MaterialTypeController::class, 'index'])->middleware('permission:list_material_type');
    Route::post('create', [MaterialTypeController::class, 'create'])->middleware('permission:create_material_type');
    Route::put('update/{id}', [MaterialTypeController::class, 'update'])->middleware('permission:update_material_type');
    Route::delete('delete/{id}', [MaterialTypeController::class, 'delete'])->middleware('permission:delete_material_type');
});

Route::middleware('auth:sanctum')->prefix('materials')->group(function () {
    Route::get('list', [MaterialController::class, 'index'])->middleware('permission:list_material');
    Route::post('create', [MaterialController::class, 'create'])->middleware('permission:create_material');
    Route::put('update/{id}', [MaterialController::class, 'update'])->middleware('permission:update_material');
    Route::delete('delete/{id}', [MaterialController::class, 'delete'])->middleware('permission:delete_material');
});

Route::middleware('auth:sanctum')->prefix('companies')->group(function () {
    Route::get('list', [CompanyController::class, 'index'])->middleware('permission:list_company');
    Route::post('create', [CompanyController::class, 'create'])->middleware('permission:create_company');
    Route::put('update/{id}', [CompanyController::class, 'update'])->middleware('permission:update_company');
    Route::delete('delete/{id}', [CompanyController::class, 'delete'])->middleware('permission:delete_company');
});

Route::middleware('auth:sanctum')->prefix('sales')->group(function () {
    Route::get('list', [SaleController::class, 'index'])->middleware('permission:list_sale');
    Route::post('create', [SaleController::class, 'create'])->middleware('permission:create_sale');
});

Route::middleware('auth:sanctum')->prefix('payments')->group(function () {
    Route::get('list', [PaymentController::class, 'index'])->middleware('permission:list_payment');
    Route::post('create', [PaymentController::class, 'create'])->middleware('permission:create_payment');
});

Route::middleware('auth:sanctum')->prefix('expances')->group(function () {
    Route::get('list', [ExpanceController::class, 'index'])->middleware('permission:list_expance');
    Route::post('create', [ExpanceController::class, 'create'])->middleware('permission:create_expance');
});