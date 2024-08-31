<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::post('login',[AuthController::class,'login'])->name('postlogin');
Route::post('/set_language',[Controller::class,'set_language'])->name('set_language');


//private Route
Route::group(['middleware'=> ['auth:user']], function () {
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');

    //Product
    Route::prefix('product')->group(function () {
        //company
        Route::prefix('list-product')->group(function () {
            Route::get('',[ProductController::class,'index']);
            Route::get('add',[ProductController::class,'add']);
            Route::post('list',[ProductController::class,'list_data']);
            Route::post('post',[ProductController::class,'post']);
            Route::post('update',[ProductController::class,'update']);
            Route::get('/{id}',[ProductController::class,'detail']);
            Route::get('edit/{id}',[ProductController::class,'edit']);
            Route::post('active',[ProductController::class,'active']);
            Route::post('nonactive',[ProductController::class,'nonactive']);
            Route::post('delete',[ProductController::class,'delete']);
        });
    });

    //transaction
    Route::prefix('transaction')->group(function () {
        //company
        Route::prefix('list-transaction')->group(function () {
            Route::get('',[TransactionController::class,'index']);
            Route::post('list',[TransactionController::class,'list_data']);
            Route::post('update',[TransactionController::class,'update']);
            Route::get('/{id}',[TransactionController::class,'detail']);
        });
    });
    
});