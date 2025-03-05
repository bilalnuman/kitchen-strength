<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Validator as FacadesValidator;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role ? $request->role : 'user';
        $user->password = FacadesHash::make($request->password);
        $res = $user->save();

        if ($res) {
            return response()->json([
                'message' => 'User registered successfully.',
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to register user. Please try again.'
            ], 400);
        }


        // auth()->login($user);

        // return redirect()->route('/');
    }
}

