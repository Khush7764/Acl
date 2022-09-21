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
    // 'middleware' => ["EnsureRoles"]
], function(){
    Route::get('all-permissions', [AclController::class, 'getAllPermissions']);
    Route::get('all-permissions/{id}', [AclController::class, 'getUserPermissions']);
    Route::get('all-roles', [AclController::class, 'getAllRoles'])->name('role.list');
    Route::get('role/view/{id?}', [AclController::class, 'viewUserRole'])->name('role.view');
    Route::post('role/create-or-update', [AclController::class, 'createOrUpdateRole'])->name('role.createOrUpdate');
});
