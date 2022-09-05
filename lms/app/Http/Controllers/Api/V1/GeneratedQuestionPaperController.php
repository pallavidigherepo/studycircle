<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneratedQuestionPaperRequest;
use App\Http\Resources\GeneratedQuestionPaperResource;
use App\Models\GeneratedQuestionPaper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneratedQuestionPaperController extends Controller
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

        return GeneratedQuestionPaperResource::collection(
            GeneratedQuestionPaper::when(request('search'), function ($query) {
                $query->where('name', 'like', '%'. request('search'). '%');
            })
                ->orderBy($field, $order)
                ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneratedQuestionPaperRequest $request)
    {
        $response = [
            'success' => false,
            'message' => 'Failed to add'
        ];
        if ($request->validated()) {
            $input = [
                'name' => $request->name,
                'subject_id' => $request->subject_id,
                'chapter_id' => $request->chapter_id,
                'topic_id' => $request->topic_id,
                'template_id' => $request->template_id,
                'difficulty_level_id' => $request->difficulty_level_id,
                'is_auto' => $request->is_auto,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'generated_questions' => json_encode($request->generated_questions),
            ];

            $generatedQuestionPaper = GeneratedQuestionPaper::create($input);

            $response = [
                'success' => true,
                'message' => 'Question paper successfully generated.',
                'generatedQuestionPaper' => $generatedQuestionPaper,
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  GeneratedQuestionPaper  $generatedQuestionPaper
     * @return \Illuminate\Http\Response
     */
    public function show(int $generatedQuestionPaper)
    {
        return new GeneratedQuestionPaperResource(GeneratedQuestionPaper::findOrFail($generatedQuestionPaper));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GeneratedQuestionPaperRequest $request, GeneratedQuestionPaper $generateQuestionPaper)
    {
        if ($request->validated()) {
            $input = [
                'name' => $request->name,
                'subject_id' => $request->subject_id,
                'chapter_id' => $request->chapter_id,
                'topic_id' => $request->topic_id,
                'template_id' => $request->template_id,
                'difficulty_level_id' => $request->difficulty_level_id,
                'is_auto' => $request->is_auto,
                'generated_questions' => $request->generated_questions,
            ];
            $generateQuestionPaper->update($input);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GeneratedQuestionPaper $generateQuestionPaper
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        $generatedQuestionPaper = GeneratedQuestionPaper::findOrFail($id);
        if ($generatedQuestionPaper->delete()) {
            unset($response);
            $response = [
                'success' => true,
                'message' => 'Question paper deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
