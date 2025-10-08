<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Resources\MaterialResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->prefix('product')->group(function () {
    Route::get('list', [ProductController::class, 'index']);
    Route::post('create', [ProductController::class, 'create']);
    Route::put('update/{id}' , [ProductController::class , 'update']);
    Route::delete('delete/{id}' , [ProductController::class , 'delete']);
});

Route::middleware('auth:sanctum')->prefix('user')->group(function(){
    Route::get('list' , [UserController::class , 'index']);
    Route::post('create' , [UserController::class , 'create']);
    Route::put('update/{id}' , [UserController::class , 'update']);
    Route::delete('delete/{id}' , [UserController::class , 'delete']);
});

Route::middleware('auth:sanctum')->prefix('permission')->group( function(){
    Route::get('list' , [PermissionController::class , 'index']);
    Route::post('create' , [PermissionController::class , 'create']);
    Route::put('update/{id}' , [PermissionController::class , 'update']);
    Route::delete('delete/{id}' , [PermissionController::class , 'delete']);
});

Route::middleware('auth:sanctum')->prefix('role')->group( function(){
    Route::get('list' , [RolesController::class , 'index']);
    Route::post('create' , [RolesController::class , 'create']);
    Route::put('update/{id}' , [RolesController::class , 'update']);
    Route::delete('delete/{id}' , [RolesController::class , 'delete']);
});

Route::middleware('auth:sanctum')->prefix('material_type')->group( function(){
    Route::get('list' , [MaterialTypeController::class , 'index']);
    Route::post('create' , [MaterialTypeController::class , 'create']);
    Route::put('update/{id}' , [MaterialTypeController::class , 'update']);
    Route::delete('delete/{id}' , [MaterialTypeController::class , 'delete']);
});

Route::middleware('auth:sanctum')->prefix('material')->group( function(){
    Route::get('list' , [MaterialController::class , 'index']);
    Route::post('create' , [MaterialController::class , 'create']);
    Route::put('update/{id}' , [MaterialController::class , 'update']);
    Route::delete('delete/{id}' , [MaterialController::class , 'delete']);
});

Route::middleware('auth:sanctum')->prefix('company')->group( function(){
    Route::get('list' , [CompanyController::class , 'index']);
    Route::post('create' , [CompanyController::class , 'create']);
    Route::put('update/{id}' , [CompanyController::class , 'update']);
    Route::delete('delete/{id}' , [CompanyController::class , 'delete']);
});