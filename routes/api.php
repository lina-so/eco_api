<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register',[App\Http\Controllers\Api\AuthController::class,'register']);

Route::post("/login",[App\Http\Controllers\Api\AuthController::class,'login']);

Route::middleware('auth:sanctum')->group( function (){
    
    Route::apiResource('settings', App\Http\Controllers\Api\SettingController::class);
    
    Route::apiResource('category', App\Http\Controllers\Api\CategoryController::class);
    
    Route::apiResource('product', App\Http\Controllers\Api\ProductController::class);
    
    Route::apiResource('subproduct', App\Http\Controllers\Api\SubProductController::class);
    
    Route::apiResource('color', App\Http\Controllers\Api\ColorController::class);
    
    Route::apiResource('size', App\Http\Controllers\Api\SizeController::class);
    
    Route::apiResource('userAddress', App\Http\Controllers\Api\userAddressController::class);
    
    Route::get('userAddressone',[App\Http\Controllers\Api\userAddressController::class,'getUserAddress']);
    
    Route::get('categoryprod',[App\Http\Controllers\Api\ProductController::class,'get_category_with_products']);
    
    Route::get('prodsubprod',[App\Http\Controllers\Api\SubProductController::class,'get_product_with_subproducts']);
    
    Route::get('subproductwithinfo',[App\Http\Controllers\Api\SubProductController::class,'get_subproducts_with_info']);

    Route::apiResource('roles',App\Http\Controllers\Api\RoleController::class);
    
    Route::apiResource('users',App\Http\Controllers\UserController::class);

    Route::apiResource('permissions',App\Http\Controllers\Api\PermissionController::class);

    Route::apiResource('favoraite',App\Http\Controllers\Api\FavoraiteController::class);

    Route::apiResource('order',App\Http\Controllers\Api\OrderController::class);
    


    Route::get('/userOrders',[App\Http\Controllers\Api\OrderController::class,'get_orders_for_user']);

    Route::get('/search',[App\Http\Controllers\Api\SearchController::class,'result']);


    Route::post('/logout',[App\Http\Controllers\Api\AuthController::class,'logout']);



});

Route::post('email/verification-notification', [App\Http\Controllers\Api\EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('verify-email/{id}/{hash}', [App\Http\Controllers\Api\EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

Route::post('forgot-password', [App\Http\Controllers\Api\NewPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [App\Http\Controllers\Api\NewPasswordController::class, 'reset']);








