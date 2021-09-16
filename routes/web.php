<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.index');
});

Route::prefix('admins')->group(function (){
    Route::get('/', [AdminController::class, 'index'])->name('admins.list');
    Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');


});

Route::prefix('companies')->group(function (){
    Route::get('/', [CompanyController::class, 'index'])->name('companies.list');
});

Route::prefix('employees')->group(function (){
    Route::get('/', [CompanyController::class, 'index'])->name('employees.list');
});
