<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginApiRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $user = User::where('danRegnum', $request->regnum)->first();

        // If user does not exist, create a new user
        if (!$user) {
            $user = User::create([
                'name' => $request->firstname,
                'danImage' => $request->image,
                'danFirstname' => $request->firstname,
                'danLastname' => $request->lastname,
                'danRegnum' => $request->regnum,
                'danAimagCityName' => $request->aimagCityName,
                'danSoumDistrictName' => $request->soumDistrictName,
                'danBagKhorooName' => $request->bagKhorooName,
                'danPassportAddress' => $request->passportAddress,
                "danGender" => $request->gender,
                'password' => Hash::make(123456),
                'role_id' => 5
            ]);
        }

        // Generate an authentication token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the response with the token and user data
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    // public function login(Request $request)
    // {
    //     try {
    //         // Validate request data
    //         $validatedData = $request->validate([
    //             'firstname' => 'required|string|max:255',
    //             'lastname' => 'required|string|max:255',
    //             'regnum' => 'required|size:10|regex:/^[А-ЯӨҮа-яөү]{2}[0-9]{8}$/u',
    //             'aimagCityName' => 'required|string|max:255',
    //             'soumDistrictName' => 'required|string|max:255',
    //             'bagKhorooName' => 'required|string|max:255',
    //             'passportAddress' => 'nullable|string|max:255',
    //             'gender' => 'required|string|max:10',
    //             'image' => 'nullable|string', // Image may not always be required
    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         // Return a custom response for validation failure
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Validation failed',
    //             'errors' => $e->errors() // This provides detailed validation errors
    //         ], 422);
    //     }

    //     // Search for the user by registration number
    //     $user = User::where('danRegnum', $validatedData['regnum'])->first();

    //     // If user does not exist, create a new user
    //     if (!$user) {
    //         $user = User::create([
    //             'name' => $validatedData['firstname'],
    //             'danImage' => $validatedData['image'] ?? null, // Optional image field
    //             'danFirstname' => $validatedData['firstname'],
    //             'danLastname' => $validatedData['lastname'],
    //             'danRegnum' => $validatedData['regnum'],
    //             'danAimagCityName' => $validatedData['aimagCityName'],
    //             'danSoumDistrictName' => $validatedData['soumDistrictName'],
    //             'danBagKhorooName' => $validatedData['bagKhorooName'],
    //             'danPassportAddress' => $validatedData['passportAddress'] ?? null,
    //             'danGender' => $validatedData['gender'],
    //             'password' => Hash::make(123456),
    //             'role_id' => 5,
    //         ]);
    //     }

    //     // Generate an authentication token for the user
    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     // Return the response with the token and user data
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //         'user' => $user
    //     ]);
    // }


    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke the token that was used to authenticate the current request
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function loginEmail(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email and password match any user
        if (!Auth::attempt($credentials)) {
            // Check if email exists
            $user = User::where('email', $request->email)->first();
            if ($user && !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Нууц үг буруу'], 401);
            }

            return response()->json(['error' => 'Мэйл хаяг эсвэл нууц үг буруу байна.'], 401);
        }

        // Generate token and return response
        $user = Auth::user();

        // Check if the user has the role 'dan'
        if (!$user->role || $user->role?->name !== 'dan') {
            return response()->json(['error' => 'ТЗЭ-ийн эрхээр нэвтрэх боломжгүй!'], 403);
        }

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function loginTze(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        // Validate request
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // Check if the email and password match any user
        if (!Auth::attempt($credentials)) {
            // Check if email exists
            $user = User::where('email', $request->email)->first();
            if ($user && !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Нууц үг буруу'], 401);
            }

            return response()->json(['error' => 'Мэйл хаяг эсвэл нууц үг буруу байна.'], 401);
        }

        // Generate token and return response
        $user = Auth::user();

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'message' => 'Амжилттай нэвтэрлээ!',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'division' => $user->division,
                'phone' => $user->phone,
                'organization' => $user->org?->name,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]);
    }
}
