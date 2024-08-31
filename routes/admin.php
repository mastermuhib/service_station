<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
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
    return view('login');
})->name('login');
//
Route::post('login',[AuthController::class,'login'])->name('loginAdmin');
Route::post('/set_language',[Controller::class,'set_language'])->name('set_language');


//private Route
Route::group(['middleware'=> ['auth:admin']], function () {
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

    //Customer
    Route::prefix('customer')->group(function () {
        Route::prefix('list-customer')->group(function () {
            Route::get('',[CustomerController::class,'index']);
            Route::get('add',[CustomerController::class,'add']);
            Route::post('list',[CustomerController::class,'list_data']);
            Route::post('action',[CustomerController::class,'action']);
            Route::post('change_password',[CustomerController::class,'change_password']);
            Route::post('post',[CustomerController::class,'post']);
            Route::post('update',[CustomerController::class,'update']);
            Route::get('/{id}',[CustomerController::class,'detail']);
            Route::get('edit/{id}',[CustomerController::class,'edit']);
            Route::post('active',[CustomerController::class,'active']);
            Route::post('nonactive',[CustomerController::class,'nonactive']);
            Route::post('delete',[CustomerController::class,'delete']);
        });
    });
    
});