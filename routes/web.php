<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// admin route here

Route::get('dashboard', [AdminController::class, 'index']);


// user related route
Route::get('dashboard/user', [UserController::class, 'index']);
Route::get('dashboard/user/add', [UserController::class, 'add']);
Route::get('dashboard/user/edit', [UserController::class, 'edit']);
Route::get('dashboard/user/view', [UserController::class, 'view']);
Route::post('dashboard/user/submit', [UserController::class, 'insert']);
Route::post('dashboard/user/update', [UserController::class, 'update']);
Route::post('dashboard/user/softdelete', [UserController::class, 'softdelete']);
Route::post('dashboard/user/restore', [UserController::class, 'restore']);
Route::post('dashboard/user/delete', [UserController::class, 'delete']);


// income Category related route
Route::get('dashboard/income/category', [IncomeCategoryController::class, 'index']);
Route::get('dashboard/income/category/add', [IncomeCategoryController::class, 'add']);
Route::get('dashboard/income/category/edit/{slug}', [IncomeCategoryController::class, 'edit']);
Route::get('dashboard/income/category/view/{slug}', [IncomeCategoryController::class, 'view']);
Route::post('dashboard/income/category/submit', [IncomeCategoryController::class, 'insert']);
Route::post('dashboard/income/category/update', [IncomeCategoryController::class, 'update']);
Route::post('dashboard/income/category/softdelete', [IncomeCategoryController::class, 'softdelete']);
Route::get('dashboard/income/category/recycle', [RecycleController::class, 'income_category']);
Route::post('dashboard/income/category/restore', [IncomeCategoryController::class, 'restore']);
Route::post('dashboard/income/category/delete', [IncomeCategoryController::class, 'delete']);

// income related route
Route::get('dashboard/income', [IncomeController::class, 'index']);
Route::get('dashboard/income/add', [IncomeController::class, 'add']);
Route::get('dashboard/income/edit/{slug}', [IncomeController::class, 'edit']);
Route::get('dashboard/income/view/{slug}', [IncomeController::class, 'view']);
Route::post('dashboard/income/submit', [IncomeController::class, 'insert']);
Route::post('dashboard/income/update', [IncomeController::class, 'update']);
Route::post('dashboard/income/softdelete', [IncomeController::class, 'softdelete']);
Route::get('dashboard/income/recycle', [RecycleController::class, 'income']);
Route::post('dashboard/income/restore', [IncomeController::class, 'restore']);
Route::post('dashboard/income/delete', [IncomeController::class, 'delete']);


// expense Category related route
Route::get('dashboard/expense/category', [ExpenseCategoryController::class, 'index']);
Route::get('dashboard/expense/category/add', [ExpenseCategoryController::class, 'add']);
Route::get('dashboard/expense/category/edit/{slug}', [ExpenseCategoryController::class, 'edit']);
Route::get('dashboard/expense/category/view/{slug}', [ExpenseCategoryController::class, 'view']);
Route::post('dashboard/expense/category/submit', [ExpenseCategoryController::class, 'insert']);
Route::post('dashboard/expense/category/update', [ExpenseCategoryController::class, 'update']);
Route::post('dashboard/expense/category/softdelete', [ExpenseCategoryController::class, 'softdelete']);
Route::get('dashboard/expense/category/recycle', [RecycleController::class, 'expense_category']);
Route::post('dashboard/expense/category/restore', [ExpenseCategoryController::class, 'restore']);
Route::post('dashboard/expense/category/delete', [ExpenseCategoryController::class, 'delete']);

// expense related route
Route::get('dashboard/expense', [ExpenseController::class, 'index']);
Route::get('dashboard/expense/add', [ExpenseController::class, 'add']);
Route::get('dashboard/expense/edit/{slug}', [ExpenseController::class, 'edit']);
Route::get('dashboard/expense/view/{slug}', [ExpenseController::class, 'view']);
Route::post('dashboard/expense/submit', [ExpenseController::class, 'insert']);
Route::post('dashboard/expense/update', [ExpenseController::class, 'update']);
Route::post('dashboard/expense/softdelete', [ExpenseController::class, 'softdelete']);
Route::get('dashboard/expense/recycle', [RecycleController::class, 'expense']);
Route::post('dashboard/expense/restore', [ExpenseController::class, 'restore']);
Route::post('dashboard/expense/delete', [ExpenseController::class, 'delete']);


require __DIR__.'/auth.php';
