<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\api\ClientController;
use App\Http\Controllers\api\ProdactController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\AuthorizationController;
use App\Http\Controllers\api\ConsumptionController;
use App\Http\Controllers\api\DefectController;
use App\Http\Controllers\api\OrdersController;
use App\Http\Controllers\api\PaymentController;
use App\Http\Controllers\api\WarehouseController;

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

Route::post('login', [AuthorizationController::class, 'login']);
Route::middleware('auth:sanctum')->name('admin.')->group(function(){
    Route::get('getme', [AuthorizationController::class, 'getme']);
    Route::post('register', [ClientController::class, 'register']);
    Route::get('clients', [ClientController::class, 'index']);
    Route::post('client/payment', [PaymentController::class, 'create']);
    Route::get('client/payment/history', [PaymentController::class, 'trasactionClientPayment']);
    Route::get('client/{client_id}/orders', [ClientController::class, 'orders'])->where('client_id', '[0-9]+');
    Route::post('warehouse', [WarehouseController::class, 'create'])->name('set.warehouse');
    Route::post('warehouse/live', [WarehouseController::class, 'create']);
    Route::get('warehouse', [WarehouseController::class, 'index']);
    Route::prefix('/categories')->group(function(){
        Route::post('/', [CategoryController::class, 'create']);
        Route::get('/', [CategoryController::class, 'index']);
        Route::patch('/{id}', [CategoryController::class, 'update']);
    });
    Route::prefix('products')->group(function(){
        Route::post('/', [ProdactController::class, 'create']);
        Route::get('/', [ProdactController::class, 'index']);
        Route::put('/{id}', [ProdactController::class, 'update']);
    });
    Route::post('order', [OrdersController::class, 'create']);
    Route::get('orders', [OrdersController::class, 'index']);
    Route::post('image', [ImageController::class, 'image']);
    Route::get('usd', [PaymentController::class, 'usd']);
    Route::prefix('consumption')->group(function(){
        Route::get('/categories', [ConsumptionController::class, 'categories']);
        Route::post('/category', [ConsumptionController::class, 'createCategory']);
        Route::post('/new', [ConsumptionController::class, 'consumption']);
        Route::get('/', [ConsumptionController::class, 'getConsumption']);
    });
    Route::get('/staff', [ConsumptionController::class, 'staffs']);
    Route::get('/balance', [ConsumptionController::class, 'balance']);
    Route::get('/profit', [ConsumptionController::class, 'profit']);
    Route::post('/defective', [DefectController::class, 'defect']);
    Route::get('/salary', [AuthorizationController::class, 'salary']);
    Route::get('/statistica/daily', [AuthorizationController::class, 'daily']);
});
