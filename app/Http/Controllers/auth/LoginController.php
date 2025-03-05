<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            if (Auth::attempt($credentials)) {
                if (auth()->user()->role === 'admin') {
                    return redirect('/dashboard');
                } else {
                    return redirect()->route('home');
                }
            }

        }
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid login details.',
        ], 401);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

