<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all courses list
        $subjects = Subject::when(request('search'), function ($query) {
                        $query->where('label', 'like', '%'. request('search'). '%');
                        $query->where('parent_id', null);
                        $query->orWhere('description', 'like', '%'. request('search'). '%');
                    })
                    ->where('parent_id', null)
                    ->with('tagged', 'courses_subjects')
                    ->orderBy(request('field'), request('sort'))
                    ->paginate(5);
        
        $languages = Language::all()->pluck('name', 'id');
        $courses = Course::all()->pluck('name', 'id');

        $tags = Subject::with('tagged')->first();
        
        $response = [
            'subjects' => $subjects,
            'languages' => $languages,
            'tags' => $tags,
            'courses' => $courses
        ];
        //$apiData = Course::getApiData();
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'label'=> json_encode($request->label),
                'description' => json_encode($request->description),
                'icon' => $request->icon,
                'language_id' => $request->language_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'parent_id' => NULL
            ];
            
    	    $tags = $request->tags;
            $subject = Subject::create($inputs);
            
            $subject->untag();
            $subject->tag($tags);
            $subject->courses_subjects()->sync($request->course_ids);
            $subject->tags = $request->tags;

            $response = [
                'success' => true,
                'message' => 'Subject is created successfully.',
                'subject' => $subject,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  Object  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $subject->tags;
        return response()->json($subject);
    }


    /**
     * Display the specified resource.
     *
     * @param  Object  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return response()->json($subject); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        if ($request->validated()) {
            $inputs = [
                'label'=> json_encode($request->label),
                'description' => json_encode($request->description),
                'icon' => $request->icon,
                'language_id' => $request->language_id,
                'updated_by' => Auth::user()->id,
                'parent_id' => NULL
            ];
            
    	    $tags = $request->tags;
            $subject->update($inputs);
            

            $subject->untag();
            $subject->tag($tags);
            $subject->courses_subjects()->sync($request->course_ids);
            $subject->tags = $request->tags;

            $response = [
                'success' => true,
                'message' => 'Subject is updated successfully.',
                'subject' => $subject,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Oops, there seems to have some errors.',
                'errors' => $this->validated()->errors(),
            ];
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        
        if ($subject->delete()) {
            $response = [
                'success' => true,
                'message' => 'Subject deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
