<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Board;
use App\Models\Standard;
use App\Models\Language;
use App\Models\QuestionDifficultyLevel;
use App\Models\QuestionType;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Topic;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all courses list
        $questions = Question::when(request('search'), function ($query) {
                $query->where('question', 'like', '%'. request('search'). '%');
                    $query->orWhere('description', 'like', '%'. request('search'). '%');
                })
                ->orderBy(request('field'), request('sort'))
                ->paginate(5);

        $tags = Question::with('tagged')->first();

        $response = [
            'questions' => $questions,
            'tags' => $tags,
            ];
        //$apiData = Course::getApiData();
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
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


    /**
     * Get all the extra options that will be required in create form
     * 
     * @return \Illuminate\Http\Response 
     */
    public function options()
    {
        $response = [];
        // Get the list of all the boards
        $boards = Board::all()->pluck('name', 'id');

        // Get the list of all the standards or classes
        $standards = Standard::all()->pluck('name', 'id');

        // Get the list of all the difficulty levels
        $difficultyLevels = QuestionDifficultyLevel::all()->pluck('name', 'id');
        
        // Get the list of all the question types
        $questionTypes = QuestionType::all()->pluck('name', 'id');

        // Get the list of all the languages
        $languages = Language::all()->pluck('name', 'id');

        // Get the list of all the subjects
        $subjects = Subject::all()->pluck('name', 'id');

        // Get the list of all the chapters
        $chapters = Chapter::all()->pluck('name', 'id');

        // Get the list of all the topics
        $topics = Topic::all()->pluck('name', 'id');

        $response = [
            'boards' => $boards,
            'standards' => $standards,
            'difficultyLevels' => $difficultyLevels,
            'questionTypes' => $questionTypes,
            'languages' => $languages,
            'subjects' => $subjects,
            'chapters' => $chapters,
            'topics' => $topics,
        ];

        
        return response()->json($response);
    }
}
