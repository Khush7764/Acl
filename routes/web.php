<?php

use App\Http\Controllers\AclController;
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
Route::group([
    'middleware' => ["ensure_roles"]
], function(){
    Route::get('all-permissions/{id}', [AclController::class, 'getUserPermissions']);
    Route::get('all-permissions', [AclController::class, 'getAllPermissions']);

    Route::get('freshGrid', [PurpleController::class, 'freshGrid']);
    Route::get('loanmatrix/freshgrid/3month', [PurpleController::class, 'threeMonthList']);
    Route::get('loanmatrix/freshgrid/3month/edit', [PurpleController::class, 'threeMonthEdit']);
    Route::get('loanmatrix/freshgrid/62Days', [PurpleController::class, 'sixtyTwoDaysList']);
    Route::get('loanmatrix/freshgrid/62Days/edit', [PurpleController::class, 'sixtyTwoDaysEdit']);
    Route::get('loanmatrix/freshgrid/6Month', [PurpleController::class, 'sixMonthList']);
    Route::get('loanmatrix/freshgrid/6Month/edit', [PurpleController::class, 'sixMonthEdit']);
    Route::get('loanmatrix/freshgrid/sendexcelreport', [PurpleController::class, 'sendExcelReport']);
    Route::get('loanmatrix/freshgrid/addnewtemplate', [PurpleController::class, 'addNewTemplate']);
    Route::get('transactionsList', [PurpleController::class, 'transactionsList']);
});
Route::get('all-permissions', [AclController::class, 'getAllPermissions']);
Route::get('all-roles', [AclController::class, 'getAllRoles']);