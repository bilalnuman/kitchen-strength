<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return view('admin.users.index');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users. Please try again later.'], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve user. Please try again later.'], 500);
        }
    }

    public function edit(string $id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve user. Please try again later.'], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255' . $id,
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string',
            ]);

            $user = User::findOrFail($id);
            $user->update($request->all());

            return response()->json(['message' => 'User updated successfully.']);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to update user. Please try again later.'], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $item = User::where('id', $id)->first();

            if ($item) {
                if ($item->delete()) {
                    return response()->json(['success' => true, 'message' => 'user deleted successfully.'], 200);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to delete user. Please try again later.'], 500);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'User not found.'], 404);
            }
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}
