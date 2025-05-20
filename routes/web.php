<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BidderController;
use App\Http\Controllers\CategoryBidderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.create');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::middleware('auth', 'check.role:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});
// Quản lý sản phẩm
Route::middleware('auth')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product.index');
        Route::get('/product/create', 'create')->name('product.create');
        Route::get('/product/{id}', 'detail')->name('product.detail');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::post('/product', 'import')->name('product.import');
        Route::post('/product/store', 'store')->name('product.store');
        Route::post('/product/update/{id}', 'update')->name('product.update');
        Route::delete('/product/destroy/{id}', 'destroy')->name('product.destroy');
    });
});
// Đấu thầu
Route::middleware('auth')->group(function () {
    Route::controller(BidderController::class)->group(function () {
        Route::get('/bidder', 'index')->name('bidder.index');
        Route::get('/bidder/create', 'create')->name('bidder.create');
        Route::get('/bidder/edit/{id}', 'edit')->name('bidder.edit');   
        Route::post('/bidder/store', 'store')->name('bidder.store');
        Route::post('/bidder', 'import')->name('bidder.import');
        Route::get('/bidder/group', 'group')->name('bidder.group');
        Route::get('/bidder/create-group', 'create_group')->name('bidder.createGroup');
        Route::get('/bidder/edit-group/{id}', 'edit_group')->name('bidder.editGroup');
        Route::post('/bidder/create-group', 'storeGroup')->name('bidder.storeGroup');
        Route::post('/bidder/update-group/{id}', 'update_group')->name('bidder.updateGroup');
        Route::delete('/bidder/destroy-group/{id}', 'destroy_group')->name('bidder.destroyGroup');
        Route::get('/get-categories-by-city/{cityId}', 'getCategory')->name('categories.byCity');
        Route::get('/get-group-by-categories/{categoryId}', 'getGroup')->name('categories.byCategory');
        Route::get('/get-group-by-date/{date}', 'getGroupByDate');
    });
});
// Danh sách bệnh viện
Route::middleware('auth')->group(function () {
    Route::controller(CategoryBidderController::class)->group(function () {
        Route::get('/category-bidder', 'index')->name('category.index');
        Route::get('/category-bidder/{code}/{group}', 'detail')->name('category.detail');
        Route::get('/create-bidder', 'create')->name('categorybidder.create');
        Route::post('/create-bidder', 'store')->name('categorybidder.store');
    });
});
// Hồ sơ thầu
Route::middleware('auth')->group(function () {
    Route::controller(DocumentController::class)->group(function () {
        Route::get('/document', 'index')->name('document.index');
        Route::get('/edit-document/{code}/{group}', 'edit')->name('document.edit');
        Route::put('/update-document/{code}/{group}', 'update')->name('document.update');
        Route::get('/create-document', 'create')->name('document.create');
        Route::post('/create-document', 'store')->name('document.store');
        Route::post('/documents/export', 'exportExcel')->name('documents.exportExcel');
        Route::post('/documents/export-word', 'exportWord')->name('documents.exportWord');
        Route::post('/documents/export-contract', 'exportContract')->name('documents.exportContract');
        Route::post('/documents/export-contract-phuluc', 'exportContractPhuluc')->name('documents.exportContractPhuluc');
        Route::get('/bid', 'bid')->name('document.bid');
        Route::get('/bid/detail/{code}/{group}', 'bidDetail')->name('document.bidDetail');
        Route::post('/bid/update', 'bidUpdate')->name('document.bidUpdate');
        Route::get('/document-log', 'docLogs')->name('document.docLog');
        Route::get('/document-log/{code}/{group}', 'docLogDetail')->name('document.docLogDetail');
    });
});
// Báo giá
Route::middleware('auth')->group(function () {
    Route::controller(ExchangeController::class)->group(function () {
        Route::get('/exchange', 'index')->name('exchange.index');
        Route::get('/exchange/detail/{date}', 'detail')->name('exchange.detail');
        Route::get('/exchange/create', 'create')->name('exchange.create');
        Route::post('/exchange/store', 'store')->name('exchange.store');
        Route::post('/exchange/update/{date}', 'update')->name('exchange.update');
        Route::post('/exchange/exportWord', 'exportWord')->name('exchange.exportWord');
        Route::post('/exchange/import', 'import')->name('exchange.import');
    });
});
// Quản lý người dùng
Route::middleware('auth', 'check.role:admin')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/create', 'create')->name('user.create');
        Route::post('/user/store', 'store')->name('user.store');
        Route::get('/user/{id}', 'detail')->name('user.detail');
    });
});
