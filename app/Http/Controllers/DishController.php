<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    public function index()
    {
        try {
            $dishes = Dish::all();
            return response()->json($dishes);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve dishes. Please try again later.'], 500);
        }
    }

    public function create()
    {
        $dishes = Dish::all();
        return view('admin.dish.create', compact('dishes'));
    }

    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:dishes,name',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            Dish::create($request->all());

            $dishes = Dish::all();
            return view('admin.dish.create', compact('dishes'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create Dish. Please try again later.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $dish = Dish::findOrFail($id);
            return response()->json($dish);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Dish not found.'], 404);
        }
    }

    public function edit($id)
    {
        try {
            $dish = Dish::findOrFail($id);
            return response()->json($dish);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Dish not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:dishes,name,' . $id,
            ]);

            $dish = Dish::findOrFail($id);
            $dish->update($request->all());

            return response()->json(['message' => 'Dish updated successfully.']);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to update Dish. Please try again later.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $dish = Dish::findOrFail($id);
            $dish->delete();

            return response()->json(['message' => 'Dish deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Dish. Please try again later.'], 500);
        }
    }
}


