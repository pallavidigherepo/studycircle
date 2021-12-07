<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\CoursesTypeController;
use App\Http\Controllers\Api\V1\SubjectController;
use App\Http\Controllers\Api\V1\ChapterController;
use App\Http\Controllers\Api\V1\TopicController;
use App\Http\Controllers\Api\V1\ExportController;
use App\Http\Controllers\Api\V1\ImportController;
use App\Http\Controllers\Api\V1\QuestionController;

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
Route::middleware('api')->group(function () {
    Route::middleware('auth:sanctum')->group(
        function () {
            Route::get('v1/permissions/modules', [PermissionController::class, 'modules'])->name('permissions.modules');
            Route::resource('v1/permissions', PermissionController::class);
            
            Route::resource('v1/roles', RoleController::class);
            Route::resource('v1/users', UserController::class);
            Route::resource('v1/courses_type', CoursesTypeController::class);
            Route::get('v1/courses_type/list', [CoursesTypeController::class, 'list'])->name('coursesType.list');
            Route::resource('v1/courses', CourseController::class);
            Route::resource('v1/subjects', SubjectController::class);
            Route::resource('v1/chapters', ChapterController::class);
            Route::resource('v1/topics', TopicController::class);
            Route::post('v1/exports/index', [ExportController::class, 'index'])->name('exports.index');
            Route::post('v1/imports', [ImportController::class, 'store'])->name('imports.store');
            Route::get('v1/questions/options', [QuestionController::class, 'options'])->name('questions.options');
            Route::resource('v1/questions', QuestionController::class);
        });
    
});
