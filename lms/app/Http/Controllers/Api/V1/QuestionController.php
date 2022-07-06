<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Http\Requests\QuestionRequest;
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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

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
                $query->where('question', NULL);
                $query->where('question', 'like', '%'. request('search'). '%');                
            })
            ->whereNull('parent_id')
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
    public function store(QuestionRequest $request)
    {
        // First most: Validate all the request data.
        if ($request->validated()) {
            $parentQuestion = $this->__createAndUpdateQuestion($request->toArray());
            // When question is created we need to check if the added question has $request['questions']
            // If yes then we have save all the questions and approriate answers.
            if (!empty($request['questions'])) {
                $questions = $request['questions'];
                
                foreach ($questions as $question) {
                    $pQuestion = $this->__createAndUpdateQuestion($question, $parentQuestion);
                    // After question is saved/created successfully, we need to add 
                    // answers of that created question.
                    $this->__createAndUpdateAnswer($question['answers'], $pQuestion);
                }
            } else {
                // After question is saved/created successfully, we need to add 
                // answers of that created question.
                $this->__createAndUpdateAnswer($request['answers'], $parentQuestion);
            }
            $response = [
                'success' => true,
                'message' => 'Successfully added'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to add'
            ];
        }
        
        return response()->json($response, 200);
    }

    private function __createAndUpdateQuestion(Array $inputArray, Question $parentQuestion = null)
    {
        //dump($inputArray);
        $id = null;
        if (isset($inputArray['id'])) {
            //dump($inputArray['id']);
            $alreadyAQuestion = Question::find($inputArray['id']);
            if ($alreadyAQuestion != null) {
                $id = $alreadyAQuestion->id != null ? $alreadyAQuestion->id: null;
            }
            
        }
        //dump($id);
        $inputQuestionData = [
            "id" => $id,
            'parent_id' => $parentQuestion ? $parentQuestion->id: NULL,
            'question' => $inputArray['question'],
            'description' => $inputArray['description'],
            'note' => $inputArray['note'],
            "type_id" => $inputArray['type_id'],
            'board_id' => $parentQuestion ? $parentQuestion->board_id: $inputArray['board_id'],
            "standard_id" => $parentQuestion ? $parentQuestion->standard_id: $inputArray['standard_id'],
            "difficulty_level_id" => $parentQuestion ? $parentQuestion->difficulty_level_id: $inputArray['difficulty_level_id'],
            "subject_id" => $parentQuestion ? $parentQuestion->subject_id: $inputArray['subject_id'],
            "chapter_id" => $parentQuestion ? $parentQuestion->chapter_id: $inputArray['chapter_id'],
            "topic_id" => $parentQuestion ? $parentQuestion->topic_id: $inputArray['topic_id'],
            "language_id" => $parentQuestion ? $parentQuestion->language_id: $inputArray['language_id'],
            "created_by" => Auth::user()->id,
            "updated_by" => Auth::user()->id,
            "marks" => $inputArray['marks'],
            "negative_marks" => $inputArray['negative_marks'],
        ]; 
        if ($id) {
            if ($alreadyAQuestion->update($inputQuestionData)) {
                return $alreadyAQuestion;
            }
            return ;
        } else {
            return Question::create($inputQuestionData);
        }
    }


    private function __createAndUpdateAnswer(Array $answers, Question $question)
    {
        if (!empty($answers)) {
            // Get ids as plain array of existing answers
            $existingIds = $question->answers()->pluck('id')->toArray();
            // Get ids as plain array of new answers
            $newIds = Arr::pluck($answers, 'id');
            // Find answers to delete
            $toDelete = array_diff($existingIds, $newIds);
            //Find answers to add
            $toAdd = array_diff($newIds, $existingIds);
            
            // Delete answers by $toDelete array
            Answer::destroy(collect($toDelete));
            // Create new answers
            foreach ($answers as $answer) {
                if (in_array($answer['id'], $toAdd)) {
                    if ($answer['is_correct'] == "on" || $answer['is_correct'] == 1) {
                        $isCorrect = 1;
                    } else {
                        $isCorrect = 0;
                    }
                    $answer['is_correct'] = $isCorrect;
                    $answer['question_id'] = $question->id;
                    $answer['created_by'] = Auth::user()->id;
                    $answer['updated_by'] = Auth::user()->id;
                    $this->__createAnswer($answer, $question);
                }
            }

            // Update existing answers
            $answerMap = collect($answers)->keyBy('id');
            foreach ($question->answers as $answer) {
                if (isset($answerMap[$answer->id])) {
                    if ($answer['is_correct'] == "on" || $answer['is_correct'] == 1) {
                        $isCorrect = 1;
                    } else {
                        $isCorrect = 0;
                    }
                    $answer['is_correct'] = $isCorrect;
                    $answer['updated_by'] = Auth::user()->id;
                    //$answer['question_id'] = $question->id;
                    $this->__updateAnswer($answer, $answerMap[$answer->id]);
                }
            }
        }
    }

    private function __createAnswer($data, $question)
    {
        $validator = Validator::make($data, [
            'answer' => 'required|string',
            'question_id' => 'exists:App\Models\Question,id',
            'created_by' => 'exists:App\Models\User,id',
            'updated_by' => 'exists:App\Models\User,id',
            'is_correct' => 'required',
        ]);
        return Answer::create($validator->validated());
    }

    /**
     * Update a answer and return true or false
     *
     * @param \App\Models\Answer $answer
     * @param $data
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     * @author Pallavi Dighe <pallavi@meritest.in>
     */
    private function __updateAnswer(Answer $answer, $data)
    {
        $validator = Validator::make($data, [
            'id' => 'exists:App\Models\Answer,id',
            'answer' => 'required|string',
            'updated_by' => 'exists:App\Models\User,id',
            'is_correct' => 'required',
        ]);

        return $answer->update($validator->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Request $request)
    {
        $question = Question::with('questions.answers', 
                                    'questions', 
                                    'answers', 
                                    'board', 
                                    'standard', 
                                    'languages',
                                    'question_type',
                                    'difficulty_level',
                                    'subject',
                                    'chapter',
                                    'topic',
                                    'creator',
                                    'updator')
                                ->find($question->id);
        return response()->json($question, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\QuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        //dd($request);
        // First most: Validate all the request data.
        if ($request->validated()) {
            $parentQuestion = $this->__createAndUpdateQuestion($request->toArray());
            // When question is created we need to check if the added question has $request['questions']
            // If yes then we have save all the questions and approriate answers.
            if (!empty($request['questions'])) {
                $questions = $request['questions'];
                
                foreach ($questions as $question) {
                    $pQuestion = $this->__createAndUpdateQuestion($question, $parentQuestion);
                    // After question is saved/created successfully, we need to add 
                    // answers of that created question.
                    $this->__createAndUpdateAnswer($question['answers'], $pQuestion);
                }
            } else {
                // After question is saved/created successfully, we need to add 
                // answers of that created question.
                $this->__createAndUpdateAnswer($request['answers'], $parentQuestion);
            }
            $response = [
                'success' => true,
                'message' => 'Successfully added'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to add'
            ];
        }
        
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        // First of all delete all the answers and then delete question.
        $question->answers()->delete();
        if ($question->delete()) {            
            $response = [
                'success' => true,
                'message' => 'Question deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
