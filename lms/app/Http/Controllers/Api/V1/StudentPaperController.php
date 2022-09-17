<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\GeneratedQuestionPaper;
use App\Models\StudentPaper;
use App\Http\Requests\StoreStudentPaperRequest;
use App\Http\Requests\UpdateStudentPaperRequest;
use App\Http\Resources\StudentPaperResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


/**
 *
 */
class StudentPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;

        return StudentPaperResource::collection(
            StudentPaper::when(request('search'), function ($query) {
                //$query->where('name', 'like', '%' . request('search') . '%');
            })
                ->orderBy($field, $order)
                ->paginate($perPage)
        );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentPaperRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStudentPaperRequest $request)
    {
        if ($request->validated()) {
            $input = [
                'generated_question_paper_id' => $request->generated_question_paper_id,
                'batch_id' => $request->batch_id,
                'course_id' => $request->course_id,
                'solved_questions' => $request->solved_questions,
                'total_marks' => $request->solved_questions['template_info']['total_marks'],
                'total_time' => $request->solved_questions['template_info']['duration'],
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            // First of all we need to check if student is already assigned with this question_paper_id
            $existingStudentIds = StudentPaper::where('generated_question_paper_id', $request->generated_question_paper_id)
                ->where('batch_id', $request->batch_id)
                ->where('course_id', $request->course_id)
                ->get()
                ->pluck('student_id')->toArray();

            // List of students teacher has selected.
            $newStudentIds = Arr::pluck($request->students, 'id');

            // Add only those who are not assigned with question_paper
            $studentToAdd = array_diff($newStudentIds, $existingStudentIds);

            $studentPaper = [];
            if (!empty($studentToAdd)) {
                $i = 0;
                foreach ($studentToAdd as $studentId) {
                    $input['student_id'] = $studentId;
                    $studentPaper[$i++] = StudentPaper::create($input);
                }
            }

            $response = [
                'success' => true,
                'message' => 'Paper assigned to student successfully.',
                'student_paper' => $studentPaper,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  StudentPaper $studentPaper
     * @return StudentPaperResource
     */
    public function show(StudentPaper $studentPaper)
    {
        return new StudentPaperResource(StudentPaper::findOrFail($studentPaper->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStudentPaperRequest  $request
     * @param  StudentPaper  $studentPaper
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStudentPaperRequest $request, StudentPaper $studentPaper)
    {
        if ($request->validated()) {
            $studentPaper->update($this->saveFields($request));

            $response = [
                'success' => true,
                'message' => 'Student created successfully.',
                'student_paper' => $studentPaper,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  StudentPaper $studentPaper
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(StudentPaper $studentPaper)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($studentPaper->delete()) {
            $response = [
                'success' => true,
                'message' => 'Student paper deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
