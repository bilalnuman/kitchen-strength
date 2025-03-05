<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DietController extends Controller
{
    public function index()
    {
        try {
            $diets = Diet::all();
            return response()->json($diets);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve diets. Please try again later.'], 500);
        }
    }

    public function create()
    {
        $diets = Diet::all();
        return view('admin.diet.create', compact('diets'));
    }

    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:diets,name',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            Diet::create($request->all());
            $diets = Diet::all();
            return view('admin.diet.create', compact('diets'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create diet. Please try again later.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $diet = Diet::findOrFail($id);
            return response()->json($diet);
        } catch (\Exception $e) {
            return response()->json(['error' => 'diet not found.'], 404);
        }
    }

    public function edit($id)
    {
        try {
            $diet = Diet::findOrFail($id);
            return response()->json($diet);
        } catch (\Exception $e) {
            return response()->json(['error' => 'diet not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:diets,name,' . $id,
            ]);

            $diet = Diet::findOrFail($id);
            $diet->update($request->all());

            return response()->json(['message' => 'diet updated successfully.']);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to update diet. Please try again later.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $diet = Diet::findOrFail($id);
            $diet->delete();

            return response()->json(['message' => 'diet deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete diet. Please try again later.'], 500);
        }
    }
}
