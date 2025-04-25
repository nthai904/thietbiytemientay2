<?php

use App\Http\Controllers\BidderController;
use App\Http\Controllers\CategoryBidderController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard.index');
});
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');

Route::post('/product', [ProductController::class, 'import'])->name('product.import');

Route::get('/bidder', [BidderController::class, 'index'])->name('bidder.index');

Route::get('/bidder/create', [BidderController::class, 'create'])->name('bidder.create');

Route::post('/bidder/store', [BidderController::class, 'store'])->name('bidder.store');

Route::post('/bidder', [BidderController::class, 'import'])->name('bidder.import');

Route::get('/category-bidder', [CategoryBidderController::class, 'index'])->name('category.index');

Route::get('/category-bidder/{code}', [CategoryBidderController::class, 'detail'])->name('category.detail');

Route::get('/create-bidder', [CategoryBidderController::class, 'create'])->name('categorybidder.create');

Route::post('/create-bidder', [CategoryBidderController::class, 'store'])->name('categorybidder.store');

Route::get('/document', [DocumentController::class, 'index'])->name('document.index');

Route::get('/edit-document/{code}', [DocumentController::class, 'edit'])->name('document.edit');

Route::put('/update-document/{code}', [DocumentController::class, 'update'])->name('document.update');

Route::get('/create-document', [DocumentController::class, 'create'])->name('document.create');

Route::post('/create-document', [DocumentController::class, 'store'])->name('document.store');

Route::post('/documents/export', [DocumentController::class, 'exportExcel'])->name('documents.exportExcel');

Route::post('/documents/export-word', [DocumentController::class, 'exportWord'])->name('documents.exportWord');

Route::post('/documents/export-contract', [DocumentController::class, 'exportContract'])->name('documents.exportContract');

Route::post('/documents/export-contract-phuluc', [DocumentController::class, 'exportContractPhuluc'])->name('documents.exportContractPhuluc');
