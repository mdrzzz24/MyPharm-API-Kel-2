<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTransactionController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/partner', [PartnerController::class, 'index']);
Route::post('/payment', [PartnerController::class, 'pay']);
Route::post('/status', [PartnerController::class, 'status']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth','isAdmin')->group(function(){
    Route::get('/', [AdminController::class, 'index'] );
    Route::get('/cart', [TransactionController::class, 'cart'] );
    Route::get('/pay', [TransactionController::class, 'pay']);
    Route::post('/addcart', [TransactionController::class, 'addcart'] );
    Route::get('/find', [AdminController::class, 'find'] );
    Route::get('/{id}', [AdminController::class, 'DetailProduct'] );
    Route::delete('delete/{id}', [AdminController::class, 'DeleteProduct'] );
    Route::put('/{id}/update', [AdminController::class, 'UpdateProduct'] );
    Route::post('/addproduct', [AdminController::class, 'AddProduct'] );

});
Route::prefix('user')->middleware('auth','isUser')->group(function(){
    Route::get('/', [UserController::class, 'index'] );
    Route::get('/cart', [UserTransactionController::class, 'cart'] );
    Route::get('/shipping-details', [UserTransactionController::class, 'shipping_details'] );
    Route::post('/addcart', [UserTransactionController::class, 'addcart'] );
    Route::post('/detailorder', [UserTransactionController::class, 'detailorder'] );
    Route::get('/pay', [UserTransactionController::class, 'pay']);
    Route::get('/myorder', [UserController::class, 'myorder']);
    Route::get('/ondelivey', [UserController::class, 'ondelivery']);
    // Route::get('/find', [AdminController::class, 'find'] );
    // Route::get('/{id}', [AdminController::class, 'DetailProduct'] );
    // Route::delete('delete/{id}', [AdminController::class, 'DeleteProduct'] );
    // Route::put('/{id}/update', [AdminController::class, 'UpdateProduct'] );
    // Route::post('/addproduct', [AdminController::class, 'AddProduct'] );

});
