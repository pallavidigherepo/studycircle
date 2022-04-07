<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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

        $users = UserResource::collection(
            User::when(request('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
                $query->orWhere('email', 'like', '%' . request('search') . '%');
                $query->orWhere('mobile_no', 'like', '%' . request('search') . '%');
            })->orderBy($field, $order)->paginate($perPage)
        );
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'designation' => $request->designation,
                'password' => Hash::make(123456789)
            ];
            $user = User::create($inputs);
            $user->assignRole($inputs['designation']);
            $response = [
                'success' => true,
                'message' => 'User created successfully.',
                'user' => $user,
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


    public function edit(User $user) {
        return response()->json($user, 200);
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
    public function update(UserRequest $request, User $user)
    {
        if ($request->validated()) {
            $inputs = [
                'name'=> $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'designation' => $request->designation,
            ];
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->designation = $request->designation;

            $user->save($inputs);
            $user->assignRole($inputs['designation']);

            $response = [
                'success' => true,
                'message' => 'User updated successfully.',
                'role' => $user,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function role_list()
    {
        return response()->json(Role::all()->pluck('name', 'id'), 200);
    }

    public function is_email_exists($email, $id = null) {
        if ($id != null) {
            $user = User::where([['email', '=', $email], ['id', '!=', $id]])->get()->toArray();
        } else {
            $user = User::where('email', $email)->get()->toArray();
        }
        $response = [];
        if (!empty($user)) {
            $response = [
                'message' => "This email address already exists."
            ];
        }
        return response()->json($response, 200);
        
        
    }
}
