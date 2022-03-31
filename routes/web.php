<?php

use App\Http\Controllers\api\ProdactController;
use App\Http\Middleware\Lang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\LoginController;
use App\Imports\ProductImport;


Route::redirect('/', '/admin');


Route::get('/admin/login', [LoginController::class, 'login'])->name('web.admin.login');
Route::post('/admin/login', [LoginController::class, 'Checklogin'])->name('web.admin.login.check');

Route::middleware(['auth:sanctum', Lang::class])->prefix('/admin')->group(function(){
    Route::get('/', function () {
        return view('admin.index');
    })->name('web.index');
    Route::get('/getme', function(){
        return Auth()->user()->role;
    });
    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('web.categories');

    Route::get('/products', function () {
        return view('admin.products');
    })->name('web.products');

    Route::get('/clients', function () {
        return view('admin.clients');
    })->name('web.clients');

    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('web.orders');

    Route::get('/warehouse', function () {
        return view('admin.warehouse');

    })->name('web.warehouse');

    Route::get('/warehouse/few', function () {
        return view('admin.little-product');
    })->name('web.warehouse.few');

    Route::get('/warehouse/add', function () {
        return view('admin.warehouse-add');
    })->name('web.warehouse.add');
    Route::get('/warehouse/minus', function () {
        return view('admin.warehouse-min');
    })->name('web.warehouse.min');

    Route::get('/transaction', function () {
        return view('admin.transaction');
    })->name('web.transaction');

    Route::get('/new-admin', function () {
        return view('admin.admin');
    })->name('web.admin');
    Route::get('/consumption', function () {
        return view('admin.consumption');
    })->name('web.consumption');
    Route::view('/income', 'admin.income')->name('web.income');
    Route::view('/defect', 'admin.defect')->name('web.warehouse.defect');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/set-language/{lang}', [LangController::class, 'set'])->name('set.lang');
    Route::view('/defect/show/', 'admin.defect-show')->name('defect.show');
});

Route::post('/import', [ProdactController::class, 'import'])->name('import');
Route::get('/export', [ProdactController::class, 'export'])->name('export');
