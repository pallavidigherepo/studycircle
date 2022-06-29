<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Language;
use App\Models\QuestionDifficultyLevel;
use App\Models\QuestionType;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
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

        $questions = QuestionResource::collection(
            Question::when(request('search'), function ($query) {
                $query->where('question', null);
            })
            ->orderBy($field, $order)
            ->paginate($perPage)
        );
        return $questions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        //dd($request);
        // First most: Validate all the request data.
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $questionCreated = Question::create($data);
        // When question is created we need to check if the added question has $request['questions']
        // If yes then we have save all the questions and approriate answers.
        if (!empty($request['questions'])) {
            $questions = $request['questions'];
            
            foreach ($questions as $question) {
                $inputQuestionData = [
                    'parent_id' => $questionCreated->id,
                    'question' => $question['question'],
                    'description' => $question['description'],
                    'note' => $question['note'],
                    "type_id" => $question['type_id'],
                    'board_id' => $data['board_id'],
                    "standard_id" => $data['standard_id'],
                    "difficulty_level_id" => $data['difficulty_level_id'],
                    "subject_id" => $data['subject_id'],
                    "chapter_id" => $data['chapter_id'],
                    "topic_id" => $data['topic_id'],
                    "language_id" => $data['language_id'],
                    "created_by" => Auth::user()->id,
                    "updated_by" => Auth::user()->id,
                ]; 
                
                $pQuestion = Question::create($inputQuestionData);
                // After question is saved/created successfully, we need to add 
                // answers of that created question.
                
                $answers = $question['answers'];
                if (!empty($answers)) {
                    $i = 0;
                    foreach ($answers as $answer) {
                        if ($answer['is_correct'] == "on" || $answer['is_correct'] == 1) {
                            $isCorrect = 1;
                        } else {
                            $isCorrect = 0;
                        }
                        $inputData[$i++] = [
                            'answer' => $answer['answer'],
                            'is_correct' => $isCorrect,
                            'created_by' => Auth::user()->id,
                            'updated_by' => Auth::user()->id,
                        ];
                        //$question->answers()->create($inputData);
                    }
                }
                $pQuestion->answers()->createMany($inputData);
                $pQuestion->save();
            }
        } else {
            // After question is saved/created successfully, we need to add 
            // answers of that created question.
            
            $answers = $request['answers'];
            if (!empty($answers)) {
                $i = 0;
                foreach ($answers as $answer) {
                    if ($answer['is_correct'] == "on" || $answer['is_correct'] == 1) {
                        $isCorrect = 1;
                    } else {
                        $isCorrect = 0;
                    }
                    $inputData[$i++] = [
                        'answer' => $answer['answer'],
                        'is_correct' => $isCorrect,
                        'created_by' => Auth::user()->id,
                        'updated_by' => Auth::user()->id,
                    ];
                    //$question->answers()->create($inputData);
                }
            }
            $questionCreated->answers()->createMany($inputData);
            $questionCreated->save();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
