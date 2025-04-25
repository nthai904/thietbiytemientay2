<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BidderController;
use App\Http\Controllers\CategoryBidderController;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return view('pages.dashboard.index');
});

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
});

// Category Bidder Routes
Route::controller(CategoryBidderController::class)->group(function () {
    Route::get('/category-bidder', 'index')->name('category.index');
    Route::get('/category-bidder/{code}', 'detail')->name('category.detail');
    Route::get('/create-bidder', 'create')->name('categorybidder.create');
    Route::post('/create-bidder', 'store')->name('categorybidder.store');
});

// Document Routes
Route::controller(DocumentController::class)->group(function () {
    Route::get('/document', 'index')->name('document.index');
    Route::get('/edit-document/{code}', 'edit')->name('document.edit');
    Route::put('/update-document/{code}', 'update')->name('document.update');
    Route::get('/create-document', 'create')->name('document.create');
    Route::post('/create-document', 'store')->name('document.store');
    Route::post('/documents/export', 'exportExcel')->name('documents.exportExcel');
    Route::post('/documents/export-word', 'exportWord')->name('documents.exportWord');
    Route::post('/documents/export-contract', 'exportContract')->name('documents.exportContract');
    Route::post('/documents/export-contract-phuluc', 'exportContractPhuluc')->name('documents.exportContractPhuluc');
});
