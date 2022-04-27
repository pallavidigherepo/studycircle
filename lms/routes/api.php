<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
//
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CoursesTypeController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\SubjectController;
use App\Http\Controllers\Api\V1\ChapterController;
use App\Http\Controllers\Api\V1\TopicController;

use App\Http\Controllers\Api\V1\ExportController;
use App\Http\Controllers\Api\V1\ImportController;
use App\Models\CoursesType;
use App\Models\Language;
use App\Models\Subject;

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
    Route::post('v1/logout', [AuthController::class, 'logout']);

    //
    Route::get('v1/permissions/modules', [PermissionController::class, 'modules'])->name('permissions.modules');
    Route::resource('v1/permissions', PermissionController::class);
    Route::resource('v1/roles', RoleController::class);
    Route::get('v1/users/role_list', [UserController::class, 'role_list'])->name('users.role_list');
    
    //Route::get('v1/users/is_email_exists/{email}/{id}', [UserController::class, 'is_email_exists'])->name('is_email_exists');
    Route::resource('v1/users', UserController::class);
    Route::get('v1/courses_types/list', [CoursesTypeController::class, 'list'])->name('coursesTypes.list');
    Route::resource('v1/courses_types', CoursesTypeController::class);
    Route::resource('v1/courses', CourseController::class);
    Route::resource('v1/subjects', SubjectController::class);
    Route::resource('v1/chapters', ChapterController::class);
    //Route::get('v1/topics/list', [TopicController::class, 'list'])->name('topics.list');
    Route::resource('v1/topics', TopicController::class);
    

    Route::post('v1/exports/index', [ExportController::class, 'index'])->name('exports.index');
    Route::post('v1/imports', [ImportController::class, 'store'])->name('imports.store');

    Route::get('v1/languages', function() {
        return Language::all()->pluck('name', 'id');
    })->name('languages');

    Route::get('v1/course_type_list', function() {
        return CoursesType::all()->pluck('label', 'id');
    })->name('course_type_list');

    Route::get('v1/subject_list', function() {
        return Subject::all()->where('parent_id', null)->pluck('label', 'id');
    })->name('subject_list');
   
});


Route::post('v1/login', [AuthController::class, 'login']);