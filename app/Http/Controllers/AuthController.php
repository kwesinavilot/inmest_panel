<?php

namespace App\Http\Controllers;

use App\Http\Resources\EITResource;
// use App\Models\User;
// use App\Traits\Essentials;
// use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Rules\MESTDomainOnly;

class AuthController extends APIBaseController
{
    // use Essentials;

    // public function register(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'firstname' => ['required', 'string', 'max:30', 'min:2', 'alpha_dash'],
    //             'lastname' => ['required', 'string', 'max:50', 'min:2', 'alpha_dash'],
    //             'email' => ['required', 'string', 'email', 'max:150', Rule::unique(User::class)],
    //             'phonenumber' => ['required', 'string', 'max:10', Rule::unique(User::class)],
    //             'password' => ['required', 'string', Password::min(8)->letters()->numbers()],
    //         ]);

    //         if ($validator->fails()) {
    //             return $this->errorResponse('Validation error', $validator->errors(), 401);
    //         }

    //         $eit = User::create([
    //             'userID' => $this->generateAdminOrUserId('user'),
    //             'firstname' => $request->firstname,
    //             'lastname' => $request->lastname,
    //             'email' => $request->email,
    //             'phonenumber' => $request->phonenumber,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         event(new Registered($eit));

    //         $payload = [
    //             'user' => UserResource::make($eit),
    //             'token' => $eit->createToken('userToken')->plainTextToken
    //         ];

    //         return $this->successResponse($payload, "User created successfully", 201);
    //     } catch (\Throwable $exception) {
    //         return $this->errorResponse("Something went wrong", $exception->getMessage(), 500);
    //     }
    // }

    public function EITLogin(Request $request)
    {
        // dd($request);
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'exists:student', new MESTDomainOnly()],
                'password' => ['required', 'alpha_num', 'min:8', 'max:20']
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validation error', $validator->errors(), 401);
            } else {
                $credentials = $request->only('email', 'password');
            }

            if (Auth::guard('student')->attempt($credentials)) {
                //Authentication passed...get user details and create response payload
                $eit = Auth::guard('student')->user();

                $payload = [
                    'user' => EITResource::make($eit),
                    'token' => $eit->createToken('userToken')->plainTextToken
                ];

                return $this->successResponse($payload, "Login successfully");
            } else {
                $errors = [
                    'phonenumber' => ['The provided credentials are incorrect.'],
                ];

                return $this->errorResponse('Authentication error', $errors, 401);
            }
        } catch (\Throwable $exception) {
            return $this->errorResponse("Something went wrong", $exception->getMessage(), 500);
        }
    }

    public function StaffLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'exists:users', 'min:5'],
                'password' => ['required', 'alpha_num', 'min:8', 'max:20']
            ]);

            if ($validator->fails()) {
                return $this->errorResponse('Validation error', $validator->errors(), 401);
            } else {
                $credentials = $request->only('phonenumber', 'password');
            }

            if (Auth::guard('student')->attempt($credentials)) {
                //Authentication passed...get user details and create response payload
                $eit = Auth::guard('student')->user();

                $payload = [
                    'user' => UserResource::make($eit),
                    'token' => $eit->createToken('userToken')->plainTextToken
                ];

                return $this->successResponse($payload, "Login successfully");
            } else {
                $errors = [
                    'phonenumber' => ['The provided credentials are incorrect.'],
                ];

                return $this->errorResponse('Authentication error', $errors, 401);
            }
        } catch (\Throwable $exception) {
            return $this->errorResponse("Something went wrong", $exception->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        $payload = [
            'loggedOut' => true
        ];

        return $this->successResponse($payload, "Successful logout");
    }
}
