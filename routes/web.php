<?php

use App\Http\Controllers\AclController;
use App\Http\Controllers\PurpleController;
use App\Http\Controllers\TransactionController;
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

Route::view('/', 'auth.login');
Route::group([
    'middleware' => ["auth", "ensure_roles"]
], function(){
    Route::get('all-permissions', [AclController::class, 'getAllPermissions']);
    Route::get('all-permissions/{id}', [AclController::class, 'getUserPermissions']);
    Route::get('all-roles', [AclController::class, 'getAllRoles'])->name('all-roles');
    Route::get('role/view/{id?}', [AclController::class, 'viewUserRole'])->name('role.view');
    Route::post('role/create-or-update', [AclController::class, 'createOrUpdateRole'])->name('role.createOrUpdate');
    Route::get('loanmatrix', [PurpleController::class, 'freshGrid'])->name('loanmatrix');
    Route::get('freshGrid', [PurpleController::class, 'freshGrid'])->name('freshGrid');
    Route::get('loanmatrix/freshgrid/3month', [PurpleController::class, 'threeMonthList']);
    Route::get('loanmatrix/freshgrid/3month/edit', [PurpleController::class, 'threeMonthEdit']);
    Route::get('loanmatrix/freshgrid/62Days', [PurpleController::class, 'sixtyTwoDaysList']);
    Route::get('loanmatrix/freshgrid/62Days/edit', [PurpleController::class, 'sixtyTwoDaysEdit']);
    Route::get('loanmatrix/freshgrid/6Month', [PurpleController::class, 'sixMonthList']);
    Route::get('loanmatrix/freshgrid/6Month/edit', [PurpleController::class, 'sixMonthEdit']);
    Route::get('loanmatrix/freshgrid/sendexcelreport', [PurpleController::class, 'sendExcelReport']);
    Route::get('loanmatrix/freshgrid/addnewtemplate', [PurpleController::class, 'addNewTemplate']);
    Route::get('transactions', [TransactionController::class, 'transactionsList'])->name('transactions');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', "ensure_roles"])->name('dashboard');

require __DIR__.'/auth.php';
