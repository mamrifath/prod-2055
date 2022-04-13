<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ItemController::class, 'index'])->name('items.list');
Route::get('/add-item', [ItemController::class, 'addItemNew'])->name('item.add');
Route::post('/add-item', [ItemController::class, 'addItem'])->name('add.item');
Route::get('/getItemList', [ItemController::class, 'getItemsList'])->name('get.items.list');

Route::post('/getItemDetails', [ItemController::class, 'getItemDetails'])->name('get.item.details');
Route::post('/updateItemDetails', [ItemController::class, 'updateItemDetails'])->name('update.item.details');
Route::post('/deleteItem', [ItemController::class, 'deleteItem'])->name('delete.item');
Route::post('/deleteSelectedItems', [ItemController::class, 'deleteSelectedItems'])->name('delete.selected.items');
