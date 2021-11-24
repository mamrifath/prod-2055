<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [CompanyController::class, 'index'])->name('companies.list');
Route::post('/add-company', [CompanyController::class, 'addCompany'])->name('add.company');
Route::get('/getCompanyList', [CompanyController::class, 'getCompaniesList'])->name('get.companies.list');
Route::post('/getCompanyDetails', [CompanyController::class, 'getCompanyDetails'])->name('get.company.details');
Route::post('/updateCompanyDetails', [CompanyController::class, 'updateCompanyDetails'])->name('update.company.details');
Route::post('/deleteCompanies', [CompanyController::class, 'deleteCompany'])->name('delete.company');
Route::post('/deleteSelectedCompanies', [CompanyController::class, 'deleteSelectedCompanies'])->name('delete.selected.companies');
