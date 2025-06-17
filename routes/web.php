<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/nepali', function () {
    session(['locale' => 'ne']);
    app()->setLocale('ne');
    return redirect()->back('transactions.index'); // Go back to the page they were on
});
Route::get('/english', function () {
    session(['locale' => 'en']);
    app()->setLocale('en');
    return redirect()->back('transactions.index'); // Go back to the page they were on
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::view('/nepali','nepali')->name('nepali');
Route::view('/english','english')->name('english');
Route::post('/transactions/scan', [TransactionController::class, 'scan'])->name('transactions.scan');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/scan', [TransactionController::class, 'scan'])->name('scan');
