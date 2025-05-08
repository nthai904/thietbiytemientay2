<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BidderController;
use App\Http\Controllers\CategoryBidderController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExchangeController;

Route::get('/', function () {
    return view('pages.dashboard.index');
})->name('dashboard.index');


// Product Routes
Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'index')->name('product.index');
    Route::get('/product/{id}', 'detail')->name('product.detail');
    Route::post('/product', 'import')->name('product.import');
});

// Bidder Routes
Route::controller(BidderController::class)->group(function () {
    Route::get('/bidder', 'index')->name('bidder.index');
    Route::get('/bidder/create', 'create')->name('bidder.create');
    Route::post('/bidder/store', 'store')->name('bidder.store');
    Route::post('/bidder', 'import')->name('bidder.import');
    Route::get('/bidder/group', 'group')->name('bidder.group');
    Route::get('/bidder/create-group', 'create_group')->name('bidder.createGroup');
    Route::post('/bidder/create-group', 'storeGroup')->name('bidder.storeGroup');
    Route::get('/get-categories-by-city/{cityId}', 'getCategory')->name('categories.byCity');
    Route::get('/get-group-by-categories/{categoryId}', 'getGroup')->name('categories.byCategory');
    
});

// Category Bidder Routes
Route::controller(CategoryBidderController::class)->group(function () {
    Route::get('/category-bidder', 'index')->name('category.index');
    Route::get('/category-bidder/{code}/{group}', 'detail')->name('category.detail');
    Route::get('/create-bidder', 'create')->name('categorybidder.create');
    Route::post('/create-bidder', 'store')->name('categorybidder.store');
});

// Document Routes
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
    Route::get('/bid' , 'bid')->name('document.bid');
    Route::get('/bid/detail/{code}/{group}' , 'bidDetail')->name('document.bidDetail');
});

Route::controller(ExchangeController::class)->group(function () {
    Route::get('/exchange', 'index')->name('exchange.index');
    Route::get('/exchange/detail/{date}', 'detail')->name('exchange.detail');
    Route::get('/exchange/create', 'create')->name('exchange.create');
    Route::post('/exchange/store', 'store')->name('exchange.store');
});
