<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
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

        $subjects = SubjectResource::collection(
            Subject::when(request('search'), function ($query) {
                $query->where('parent_id', null);
                $query->where('label', 'like', '%' . request('search') . '%');
                $query->orWhere('icon', 'like', '%' . request('search') . '%');
            })
                ->where('parent_id', null)
                //->with('tags', 'courses_subjects')
                ->orderBy($field, $order)
                ->paginate($perPage)
        );
        return $subjects;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $tags = $request->tags_list;
        if ($request->validated()) {
            $inputs = [
                'label' => json_encode($request->label),
                'description' => json_encode($request->description),
                'icon' => $request->icon,
                'language_id' => $request->language_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'parent_id' => NULL
            ];

            $subject = Subject::create($inputs);

            $subject->detachTags($tags);
            $subject->attachTags($tags);
            $subject->courses_subjects()->sync($request->course_ids);
            $subject->tags = $request->tags_list;

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
        return new SubjectResource(Subject::findOrFail($subject->id));
    }


    /**
     * Display the specified resource.
     *
     * @param  Object  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return new SubjectResource(Subject::findOrFail($subject->id));
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
                'label' => json_encode($request->label),
                'description' => json_encode($request->description),
                'icon' => $request->icon,
                'language_id' => $request->language_id,
                'updated_by' => Auth::user()->id,
                'parent_id' => NULL
            ];

            $subject->update($inputs);

            $subject->detachTags($request->tags_list);
            $subject->attachTags($request->tags_list);
            $subject->courses_subjects()->sync($request->course_ids);
            $subject->tags = $request->tags_list;

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
