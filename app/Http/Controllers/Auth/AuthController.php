<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // ✅ Add this line

class AuthController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }
     public function post_login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email_address' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422); // Use 422 for validation errors
    }

    if (Auth::attempt(['email' => $request->input('email_address'), 'password' => $request->input('password')])) {
        $user = Auth::user();

        if ($user->role === "admin") {
            return redirect()->route('dashboard');
        } else {
            Auth::logout();
            return response()->json([
                'error' => 'Your Email address or Password is incorrect. Please try again.'
            ], 401);
        }
    }

    return response()->json([
        'error' => 'Your Email address or Password is incorrect. Please try again.'
    ], 401);
}
}
