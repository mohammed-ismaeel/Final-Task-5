<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();



            if(Auth::user()->is_admin){
                // dd("hello");
                return redirect()->route('dashboard');
            }
            else{
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'message' => 'Access denided. You do not have permission to access this page.'
                ]);
            }
        }

        return back()->withErrors([
            'email' , 'invalid credentials'
        ]);
    }

    public function showRegistrationForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = "";
        if($request->hasFile('image')){
            $image = $request->file("image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            "image" => $imageName,
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

?>
