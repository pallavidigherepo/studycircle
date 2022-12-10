<?php

use App\Models\InquiryFollowupType;
use App\Models\InquirySource;
use App\Models\InquiryStatus;
use App\Models\User;
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
use App\Http\Controllers\Api\V1\QuestionController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\TemplateController;
use App\Http\Controllers\Api\V1\GeneratedQuestionPaperController;
use App\Http\Controllers\Api\V1\BatchController;
use App\Http\Controllers\Api\V1\StudentPaperController;
use App\Http\Controllers\Api\V1\InquiryFollowupTypeController;
use App\Http\Controllers\Api\V1\InquirySourceController;
use App\Http\Controllers\Api\V1\InquiryStatusController;
use App\Http\Controllers\Api\V1\InquiryController;
use App\Http\Controllers\Api\V1\InquiryFollowupController;

use App\Http\Controllers\Api\V1\SettingController;
use App\Http\Controllers\Api\V1\StudentParentController;

use App\Models\Board;
use App\Models\Chapter;
use App\Models\CoursesType;
use App\Models\Language;
use App\Models\QuestionDifficultyLevel;
use App\Models\QuestionType;
use App\Models\Standard;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Batch;
use App\Models\Course;
use App\Models\GeneratedQuestionPaper;
use App\Models\Template;

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

    Route::resource('v1/users', UserController::class);
    Route::get('v1/courses_types/list', [CoursesTypeController::class, 'list'])->name('coursesTypes.list');
    Route::resource('v1/batches', BatchController::class);
    Route::resource('v1/courses_types', CoursesTypeController::class);
    Route::resource('v1/courses', CourseController::class);
    Route::resource('v1/subjects', SubjectController::class);
    Route::resource('v1/chapters', ChapterController::class);
    Route::resource('v1/topics', TopicController::class);
    Route::resource('v1/questions', QuestionController::class);
    Route::resource('v1/students', StudentController::class);
    Route::resource('v1/profile', ProfileController::class);
    Route::resource('v1/templates', TemplateController::class);
    Route::resource('v1/generated_questions', GeneratedQuestionPaperController::class);
    Route::resource('v1/student_papers', StudentPaperController::class);
    Route::resource('v1/inquiry_statuses', InquiryStatusController::class);
    Route::resource('v1/inquiry_sources', InquirySourceController::class);
    Route::resource('v1/inquiry_followup_types', InquiryFollowupTypeController::class);
    Route::resource('v1/inquiries', InquiryController::class);
    Route::resource('v1/inquiry_followups', InquiryFollowupController::class);

    Route::resource('v1/parents', StudentParentController::class);
    Route::resource('v1/settings', SettingController::class);

    Route::post('v1/exports/index', [ExportController::class, 'index'])->name('exports.index');
    Route::post('v1/imports', [ImportController::class, 'store'])->name('imports.store');

    Route::get('v1/languages', function () {
        return Language::all()->pluck('name', 'id');
    })->name('languages');

    Route::get('v1/courses_list', function () {
        return Course::all()->pluck('name', 'id');
    })->name('courses_list');

    Route::get('v1/course_type_list', function () {
        return CoursesType::all()->pluck('label', 'id');
    })->name('course_type_list');

    Route::get('v1/subject_list/{boardId}/{standardId}', function ($boardId, $standardId) {
        return Subject::all()
            ->where('board_id', $boardId)
            ->where('standard_id', $standardId)
            ->where('parent_id', null)
            ->pluck('label', 'id');
    })->name('subject_list');

    Route::get('v1/get_subject_name/{subjectId}', function ($subjectId) {
        $subject = Subject::findOrFail($subjectId);
        return json_decode($subject->label);
    })->name('get_subject_name');

    Route::get('v1/chapter_list/{subjectId}', function ($subjectId) {
        return Chapter::all()->where('parent_id', $subjectId)->pluck('label', 'id');
    })->name('chapter_list');

    Route::get('v1/topic_list/{chapterId}', function ($chapterId) {
        return Topic::all()->where('parent_id', $chapterId)->pluck('label', 'id');
    })->name('topic_list');

    Route::get('v1/board_list', function () {
        return Board::all()->pluck('name', 'id');
    })->name('board_list');

    Route::get('v1/batch_list', function () {
        return Batch::all()->pluck('name', 'id');
    })->name('batch_list');

    Route::get('v1/standard_list', function () {
        return Standard::all()->pluck('name', 'id');
    })->name('standard_list');

    Route::get('v1/difficulty_level_list', function () {
        return QuestionDifficultyLevel::all()->pluck('name', 'id');
    })->name('difficulty_level_list');

    Route::get('v1/type_list', function () {
        return QuestionType::all()->where('is_active', true)->pluck('name', 'id');
    })->name('type_list');

    Route::get('v1/type_list_paragraph', function () {
        return QuestionType::all()->where('is_active', true)->where('in_paragraph', true)->pluck('name', 'id');
    })->name('type_list_paragraph');

    Route::get('v1/inquiry_sources_list', function () {
        return InquirySource::all()->pluck('name', 'id');
    })->name('inquiry_sources_list');

    Route::get('v1/inquiry_followup_types_list', function () {
        return InquiryFollowupType::all()->pluck('name', 'id');
    })->name('inquiry_followup_types_list');

    Route::get('v1/inquiry_status_list', function () {
        return InquiryStatus::all()->pluck('name', 'id');
    })->name('inquiry_status_list');

    Route::get('v1/inquiry_assignees', function () {
        return User::all()->pluck('name', 'id');
    })->name('inquiry_assignees');

    Route::get('v1/questionnaire', function () {
        $templateCount = Template::all()->count();
        $generatedQuestionPaperCount = GeneratedQuestionPaper::all()->count();
        $latestTemplates = Template::latest()->take(5)->get();
        $latestQuestionPaper = GeneratedQuestionPaper::latest()->take(5)->get();
        return compact('templateCount', 'generatedQuestionPaperCount', 'latestTemplates', 'latestQuestionPaper');
    })->name('questionnaire');
});


Route::post('v1/login', [AuthController::class, 'login']);
