<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\UserResource;
use App\Models\ProfileUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * This class is ProfileController class with all profile management related functions and variables.
 *
 * @package Meritest_LMS_Profile_Controller
 * @author Pallavi Dighe <pallavi@meritest.in>
 * @acces public
 * @version 1.0
 * @since 1.0
 * @see http://lms.meritest.in/profile
 */
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Here we will find all the data of logged-in user
        $user = Auth::user();
        $profile = ProfileUser::with([
                'user.courses' => function($query) {
                    $query->limit(5);
                    $query->orderBy('created_at', 'desc');
                },
                'user.questions' => function ($query) {
                    $query->limit(5);
                    $query->orderBy('created_at', 'desc');
                },
                'user.subjects' => function ($query) {
                    $query->limit(5);
                    $query->orderBy('created_at', 'desc');
                }])
            ->where('user_id', $user->id)
            ->get();

        return response()->json($profile[0], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $response = [];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param ProfileUser $profile
     * @return JsonResponse
     */
    public function show(ProfileUser $profile): JsonResponse
    {
        $response = [];
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ProfileUser $profile
     * @return JsonResponse
     */
    public function update(Request $request, ProfileUser $profile): JsonResponse
    {
        $inputs = $response = [];
        // First of all we need to check which form is submitted.
        // Change Password for Account information form.
        $user = Auth::user();
        if ($request->isChangePassword) {
            $eloquent = User::findOrFail($user->id);
            $inputs = [
                'password' => Hash::make($request->password),
            ];
        } else {
            // Else: User profile information will be updated.

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
            $eloquent = $profile;
            $profile->update($inputs);
        }
        if (!empty($inputs)) {
            if ($eloquent->update($inputs)) {
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
     * @param ProfileUser $profile
     * @return JsonResponse
     */
    public function destroy(ProfileUser $profile): JsonResponse
    {
        $response = [];
        return response()->json($response, 200);
    }
}
