<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Language;
use App\Models\CoursesType;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Get all courses list
        $courses = Course::when(request('search'), function ($query) {
            $query->where('name', 'like', '%'. request('search'). '%');
            $query->orWhere('course_code', 'like', '%'. request('search'). '%');
        })->with('tagged', 'courses_types')->orderBy(request('field'), request('sort'))->paginate(10);
        
        $languages = Language::all()->pluck('name', 'id');

        $courseTypes = CoursesType::all()->pluck('label', 'id');
        
        $tags = Course::with('tagged')->first();
        
        $response = [
            'courses' => $courses,
            'languages' => $languages,
            'type_ids' => $courseTypes,
            'tags' => $tags
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
    public function store(CourseRequest $request)
    {

        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'course_code' => $request->course_code,
                'type_id' => $request->type_ids,
                'language_id' => $request->language_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];
            
    	    $tags = $request->tags;
            $course = Course::create($inputs);
            $course->tag($tags);
            $course->courses_types()->sync($request->type_ids);
            $course->tags = $tags;
            $response = [
                'success' => true,
                'message' => 'Course category created successfully.',
                'course' => $course,
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
    public function update(CourseRequest $request, Course $course)
    {
        $inputs = $request->all();
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'course_code' => $request->course_code,
                'type_id' => $request->type_ids,
                'language_id' => $request->language_id,
                'updated_by' => Auth::user()->id,
            ];
            $course->update($inputs);
            
            $tags = $request->tags;
            $course->untag();
            $course->tag($tags);
            $course->courses_types()->sync($request->type_ids);
            $course->tags = $request->tags;
            $response = [
                'success' => true,
                'message' => 'Course updated successfully.',
                'course' => $course,
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
    public function destroy(Course $course)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        
        if ($course->delete()) {
            $response = [
                'success' => true,
                'message' => 'Subject deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
