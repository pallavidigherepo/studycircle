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
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;

        $coursesTypes = CourseResource::collection(
            Course::when($request->input('search'), function ($query) {
                $query->where('name', 'like', '%'. request('search'). '%');
                $query->orWhere('course_code', 'like', '%'. request('search'). '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
        return $coursesTypes;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $tags = $request->tags_list;
        //$request->tags = $request->tags_list;
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'course_code' => $request->course_code,
                'type_id' => $request->type_ids,
                'language_id' => $request->language_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];
            
    	    //$tags = $request->tags_list;
            $course = Course::create($inputs);
            $course->attachTags($tags);
            $course->courses_types()->sync($request->type_ids);
            $course->tags_list = $tags;
            $course->type_ids = $request->type_ids;
            //$recentCourse = CourseResource::collection(Course::findOrFail($course->id));
            $response = [
                'success' => true,
                'message' => 'Course created successfully.',
                'course' => $course,
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
            
            $tags = $request->tags_list;
            $course->syncTags($tags);
            $course->courses_types()->sync($request->type_ids);
            $course->tags_list = $tags;
            $course->type_ids = $request->type_ids;
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
