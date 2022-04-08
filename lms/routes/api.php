<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
//
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CoursesTypeController;

use App\Http\Controllers\Api\V1\ExportController;
use App\Http\Controllers\Api\V1\ImportController;
use App\Models\User;

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
    Route::get('v1/users/role_list', [UserController::class, 'role_list'])->name('users.role_list');
    
    Route::get('v1/users/is_email_exists/{email}/{id}', [UserController::class, 'is_email_exists'])->name('is_email_exists');
    Route::resource('v1/users', UserController::class);
    Route::get('v1/courses_types/list', [CoursesTypeController::class, 'list'])->name('coursesTypes.list');
    Route::resource('v1/courses_types', CoursesTypeController::class);
    

    Route::post('v1/exports/index', [ExportController::class, 'index'])->name('exports.index');
    Route::post('v1/imports', [ImportController::class, 'store'])->name('imports.store');
   
});


Route::post('v1/login', [AuthController::class, 'login']);