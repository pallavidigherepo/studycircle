<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\UserResource;
use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Here we will find all the data of logged in user
        $user = Auth::user();
        $profile = ProfileUser::where('user_id', $user->id)->with('user.courses', 'user.questions', 'user.subjects')->get();
        //dd($profile);
        $response = $user;
        //$profile = auth()->user()->load('profile_user', 'courses', 'questions', 'subjects'); 
        //$profile = [];
        return response()->json($profile[0], 200);
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileUser $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileUser $profile)
    {
        $inputs = $response = [];
        
        // First of all we need to check which form is submitted. 
        // Change Password for Account information form.
        if ($request->isChangePassword) {
            $user = Auth::user();
            $elequont = User::findOrFail($user->id);
            $inputs = [
                'password'=> Hash::make($request->password),
            ];
        } else {
            // Else: User profile information will be updated.
            $user = Auth::user();
            $userElequont = User::findOrFail($user->id);
            $inputs = [
                'alt_email' => $request->alt_email,
                'mobile' => $request->mobile,
                'alt_mobile' => $request->alt_mobile,
                'address' => $request->address,
                'alt_address' => $request->alt_address,
                'gender' => $request->gender,
                'qualification' => $request->qualification,
                'designation' => $request->designation,
            ];
            $elequont = $profile;
            $profile->update($inputs);
        }
        if (!empty($inputs)) {
            if ($elequont->update($inputs)) {
                $response = [
                    'success' => true,
                    'message' => 'Account information is saved successfully.',
                    'errors' => [],
                    'profile' => $profile,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Oops, there seems to have some errors.',
                    'errors' => $this->validated()->errors(),
                    'profile' => $profile,
                ];
            }
            
        }

        return response()->json($response, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileUser $profile)
    {
        //
    }
}
