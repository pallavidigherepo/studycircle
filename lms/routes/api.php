<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

//
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;

use App\Http\Controllers\Api\V1\ExportController;
use App\Http\Controllers\Api\V1\ImportController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    //
    Route::get('v1/permissions/modules', [PermissionController::class, 'modules'])->name('permissions.modules');
    Route::resource('v1/permissions', PermissionController::class);
    Route::resource('v1/roles', RoleController::class);

    Route::post('v1/exports/index', [ExportController::class, 'index'])->name('exports.index');
    Route::post('v1/imports', [ImportController::class, 'store'])->name('imports.store');
   
});


Route::post('v1/login', [AuthController::class, 'login']);