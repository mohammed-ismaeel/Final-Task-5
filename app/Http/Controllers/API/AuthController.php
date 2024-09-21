<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login Function
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password) || $user->is_block===1) {
            return response()->json([
                    'status'=>'failed',
                    'message' =>'banned or wrong info or does not exist',
            ], 401
        );
    }

        $user->tokens()->delete();
        $token = $user->createToken($user->name . 'authToken')->plainTextToken;
        $response=[
            'status' => 'success',
            'message' => 'user logged in successfully',
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ];
        return response()->json($response,201);
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = "users/default.jpg";
        if ($request->hasFile('image')) {
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'image' => $imageName,
        ]);

        $token = $user->createToken('API Token')->plainTextToken;

        $response=[
                'status' => 'success',
                'message' => 'user created successfully',
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ],
            ];
    return response()->json($response,201);
}

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' =>'success',
            'message' => 'user is logged out successfully'
        ],200);
    }
}
