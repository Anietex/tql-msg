<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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





Route::middleware('auth')->get('/', function () {
    return view('pages.index');
});

Route::middleware('guest')->group(function (){
    Route::get('/login',[AuthController::class,'show'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login-user');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admins')->group(function (){
        Route::get('/', [AdminController::class, 'index'])->name('admins.list');
        Route::get('/create', [AdminController::class, 'create'])->name('admins.create');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::post('/save',[AdminController::class, 'store'])->name('admins.save');
    });

    Route::prefix('companies')->group(function (){
        Route::get('/', [CompanyController::class, 'index'])->name('companies.list');
        Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::post('/save', [CompanyController::class,'store'])->name('companies.save');
    });

    Route::prefix('employees')->group(function (){
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.list');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::post('/save', [EmployeeController::class, 'store'])->name('employees.save');
    });
});




