<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateQuestionPaperRequest;
use App\Models\GeneratQuestionPaper;
use Illuminate\Http\Request;

class GenerateQuestionPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'generated_questions' => $request->generated_questions,
            ];

            GeneratQuestionPaper::create($input);
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
    public function update(GenerateQuestionPaperRequest $request, GeneratQuestionPaper $generatQuestionPaper)
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
            $generatQuestionPaper->update($input);
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
