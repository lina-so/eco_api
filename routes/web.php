<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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



Auth::routes();


// Route::group(['prefix' => 'home'], function () {
    
// }
// );
// Route::resource('product', App\Http\Controllers\ProductController::class);


// Route::resource('liked', App\Http\Controllers\FavoraiteController::class);

// Route::resource('orderr',App\Http\Controllers\OrderController::class);
// Route::get('/search1',[App\Http\Controllers\SearchController::class,'result']);


//lina 
Route::get("/{page}", [AdminController::class, 'index']);









