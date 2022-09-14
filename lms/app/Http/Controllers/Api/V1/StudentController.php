<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 *
 */
class StudentController extends Controller
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

        $students = StudentResource::collection(
            Student::when(request('search'), function ($query) {
                $query->where('name', 'like', '%'. request('search'). '%');
            })
            ->orderBy($field, $order)
            ->paginate($perPage)
        );
        return $students;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRequest $request
     * @return Response
     * @throws \Exception
     */
    public function store(StoreStudentRequest $request)
    {
        if ($request->validated()) {
            $student = Student::create($this->saveFields($request));

            $startOfYear = Carbon::now()->startOfYear();
            $endOfYear = Carbon::now()->endOfYear();
            $students = Student::where('created_at', '>' , $startOfYear)->where('created_at', '<', $endOfYear)->get();
            $count = count($students) + 1;

            $student->roll_number = Carbon::now()->toDateString() . '-' . $count;

            // Check if image was given and save on local file system
            if (isset($request->avatar)) {
                if ($request->avatar) {
                    $absolutePath = public_path($request->avatar);
                    File::delete($absolutePath);
                }
                $student->avatar  = $this->saveImage($request->avatar);
            }

            $student->save();

            $response = [
                'success' => true,
                'message' => 'Student created successfully.',
                'student' => $student,
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
    public function show(Student $student)
    {
        return new StudentResource(Student::findOrFail($student->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return Response
     * @throws \Exception
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        if ($request->validated()) {
            $student->update($this->saveFields($request));

            // Check if image was given and save on local file system
            if (isset($request->avatar)) {
                if ($student->avatar) {
                    $absolutePath = public_path($student->avatar);
                    File::delete($absolutePath);
                }
                $student->avatar  = $this->saveImage($request->avatar);
            }

            $student->save();

            $response = [
                'success' => true,
                'message' => 'Student created successfully.',
                'student' => $student,
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
     * Remove the specified resource from storage.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $response = [
            'success' => false,
            'message' => null,
            'errors' => null,
        ];
        if ($student->delete()) {
            $response = [
                'success' => true,
                'message' => 'Student deleted successfully.',
            ];
        }
        return response()->json($response);
    }

    /**
     * Save image in local file system and return saved image path
     *
     * @param $image
     * @throws \Exception
     * @author Pallavi Dighe <pallavi@meritest.in>
     */
    private function saveImage($image): string
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'storage/images/students/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }

    /**
     * @param array $request
     * @return array
     */
    private function saveFields($request): array
    {
        return [
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make(123456789),
            'aadhaar' => $request->aadhaar,
            'board_id' => $request->board_id,
            'standard_id' => $request->standard_id,
            'batch_id' => $request->batch_id,
            'course_id' => $request->course_id,
            'mobile' => $request->mobile,
            'alt_mobile' => $request->alt_mobile,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'permanent_address' => $request->permanent_address,
            'address' => $request->address,
            'mother_name' => $request->mother_name,
            'mother_email' => $request->mother_email,
            'mother_mobile' => $request->mother_mobile,
            'mother_qualification' => $request->mother_qualification,
            'mother_occupation' => $request->mother_occupation,
            'father_name' => $request->father_name,
            'father_email' => $request->father_email,
            'father_mobile' => $request->father_mobile,
            'father_qualification' => $request->father_qualification,
            'father_occupation' => $request->father_occupation,
            'parent_email' => $request->father_email,
            'parent_password' => Hash::make(123456789),
        ];

    }
}
