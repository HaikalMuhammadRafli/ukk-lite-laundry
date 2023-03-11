<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CashierPagesController;
use App\Http\Controllers\CashierMemberController;
use App\Http\Controllers\CashierTransactionController;
use App\Http\Controllers\OwnerPagesController;

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

Auth::routes();



Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function() {
    Route::get('/dashboard', [AdminPagesController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('members', MemberController::class);
    Route::resource('outlets', OutletController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('users', UserController::class);
    Route::resource('transactions', TransactionController::class);
    Route::get('/pay/{id}', [TransactionController::class, 'pay'])->name('transaction.pay');
    Route::get('/progress-status/{id}', [TransactionController::class, 'status'])->name('transaction.status');
    Route::get('/filter-transactions', [TransactionController::class, 'index'])->name('transaction.filter');
    Route::get('/transaction-report', [AdminPagesController::class, 'report'])->name('transaction.report');
    Route::get('/member-search', [MemberController::class, 'index'])->name('member.search');
    Route::get('/outlet-search', [OutletController::class, 'index'])->name('outlet.search');
    Route::get('/package-search', [PackageController::class, 'index'])->name('package.search');
});

Route::group(['prefix' => 'cashier', 'middleware' => ['auth', 'role:cashier']], function() {
    Route::get('/dashboard', [CashierPagesController::class, 'dashboard'])->name('cashier.dashboard');
    Route::resource('c-members', CashierMemberController::class);
    Route::resource('c-transactions', CashierTransactionController::class);
    Route::get('/pay/{id}', [CashierTransactionController::class, 'pay'])->name('cashier.transaction.pay');
    Route::get('/progress-status/{id}', [CashierTransactionController::class, 'status'])->name('cashier.transaction.status');
    Route::get('/filter-transactions', [CashierTransactionController::class, 'index'])->name('cashier.transaction.filter');
    Route::get('/transaction-report', [CashierPagesController::class, 'report'])->name('cashier.transaction.report');
    Route::get('/member-search', [CashierMemberController::class, 'index'])->name('cashier.member.search');
});

Route::group(['prefix' => 'owner', 'middleware' => ['auth', 'role:owner']], function() {
    Route::get('/transaction-report', [OwnerPagesController::class, 'report'])->name('owner.transaction.report');
});
