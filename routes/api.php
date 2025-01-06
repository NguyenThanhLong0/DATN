<?php


use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/colors', ColorController::class);


Route::apiResource('category',CategoryController::class);

// Route::middleware('auth:sanctum')->get('/customer', function (Request $request) {
//     return $request->customer();
// });


// customer
Route::apiResource('customers', CustomerController::class);

//chi tiết:
// Lấy danh sách khách hàng:
// Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');

//  Thêm mới khách hàng:
// Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');

//  Lấy chi tiết một khách hàng:
// Route::get('customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');

//  Cập nhật thông tin khách hàng:
// Route::put('customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');

//  Xóa khách hàng:
// Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');


