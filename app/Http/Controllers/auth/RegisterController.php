<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    private function generateUsername($name)
    {
        $cleanName = trim($name);
        $usernamePrefix = substr($cleanName, 0, 3);
        $randomNumbers = rand(1000, 9999);
        return $usernamePrefix . $randomNumbers;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $this->generateUsername($request->name);
        $user->email = $request->email;
        $user->role = $request->role ? $request->role : 'user';
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if ($res) {
            return redirect()->route('login')->with('success', 'User registered successfully. Please log in.');
        } else {
            return redirect()->back()->with('error', 'Failed to register user. Please try again.')->withInput();
        }
    }
}
