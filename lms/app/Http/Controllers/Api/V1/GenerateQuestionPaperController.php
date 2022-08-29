<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateQuestionPaperRequest;
use App\Http\Resources\GenerateQuestionPaperResource;
use App\Models\GenerateQuestionPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateQuestionPaperController extends Controller
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

        return GenerateQuestionPaperResource::collection(
            GenerateQuestionPaper::when(request('search'), function ($query) {
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
    public function store(GenerateQuestionPaperRequest $request)
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
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'generated_questions' => json_encode($request->generated_questions),
            ];

            GenerateQuestionPaper::create($input);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GenerateQuestionPaperRequest $request, GenerateQuestionPaper $generateQuestionPaper)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
