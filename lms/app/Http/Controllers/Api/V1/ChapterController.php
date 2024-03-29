<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Get all list
        $field = $request->input('sort_field') ?? 'id';
        $order = $request->input('sort_order') ?? 'desc';
        $perPage = $request->input('per_page') ?? 10;

        $chapters = ChapterResource::collection(
            Chapter::when(request('search'), function ($query) {
                $query->where('label', 'like', '%' . request('search') . '%');
                $query->where('parent_id', '=', request('item'));
                $query->orWhere('icon', 'like', '%' . request('search') . '%');
            })
                ->where('parent_id', '=', $request->item)
                ->with('subject')
                ->orderBy($field, $order)
                ->paginate($perPage)
        );
        return $chapters;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChapterRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'label'=> json_encode($request->label),
                'description' => json_encode($request->description),
                'icon' => $request->icon,
                'language_id' => $request->language_id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'parent_id' => $request->parent_id
            ];
            
    	    //$tags = $request->tags;
            $chapter = Chapter::create($inputs);
            $chapter->detachTags($request->tags_list);
            $chapter->attachTags($request->tags_list);
            //$chapter->tags = $request->tags;

            $response = [
                'success' => true,
                'message' => 'Subject is created successfully.',
                'chapter' => $chapter,
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
     * @param  Object  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        return new ChapterResource(Chapter::findOrFail($chapter->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        return new ChapterResource(Chapter::findOrFail($chapter->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChapterRequest $request, Chapter $chapter)
    {
        if ($request->validated()) {
            $inputs = [
                'label'=> json_encode($request->label),
                'description' => json_encode($request->description),
                'icon' => $request->icon,
                'language_id' => $request->language_id,
                'updated_by' => Auth::user()->id,
                'parent_id' => $request->parent_id
            ];
            
    	    $tags = $request->tags;
            $chapter->update($inputs);

            $chapter->detachTags($request->tags_list);
            $chapter->attachTags($request->tags_list);
            $chapter->tags = $request->tags;

            $response = [
                'success' => true,
                'message' => 'Chapter is updated successfully.',
                'chapter' => $chapter,
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
    public function destroy(Chapter $chapter)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        
        if ($chapter->delete()) {
            $response = [
                'success' => true,
                'message' => 'Chapter deleted successfully.',
            ];
        }
        return response()->json($response);
    }
}
