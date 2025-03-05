<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MethodController extends Controller
{
    public function index()
    {

        try {
            $methods = Method::all();
            return response()->json($methods);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve methods. Please try again later.'], 500);
        }
    }

    public function create()
    {
        $methods = Method::all();
        return view('admin.method.create', compact('methods'));
    }

    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:methods,name',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            Method::create($request->all());

            $methods = Method::all();
            return view('admin.method.create', compact('methods'));
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Failed to create method. Please try again later.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $method = Method::findOrFail($id);
            return response()->json($method);
        } catch (\Exception $e) {
            return response()->json(['error' => 'method not found.'], 404);
        }
    }

    public function edit($id)
    {
        try {
            $method = Method::findOrFail($id);
            return response()->json($method);
        } catch (\Exception $e) {
            return response()->json(['error' => 'method not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:methods,name,' . $id,
            ]);

            $method = Method::findOrFail($id);
            $method->update($request->all());

            return response()->json(['message' => 'method updated successfully.']);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to update method. Please try again later.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $method = Method::findOrFail($id);
            $method->delete();

            return response()->json(['message' => 'method deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete method. Please try again later.'], 500);
        }
    }
}


