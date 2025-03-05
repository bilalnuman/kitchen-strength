<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        try {
            $ingredients = Ingredient::all();
            return response()->json($ingredients);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve ingredients. Please try again later.'], 500);
        }
    }

    public function create()
    {
        return response()->json(['message' => 'Form for creating ingredient would be here.']);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'ingredient' => 'required|string|max:255',
                'recipe_id' => 'required|integer|exists:recipes,id',
               'type' => 'required|in:vegetable,fruit,protein,dairy,spice,other',
                'unit' => 'string',
            ]);
            Ingredient::create($validatedData);

            return response()->json(['message' => 'Ingredient created successfully.'], 201);
        } catch (\Exception $e) {
            return $e;
            return response()->json(['error' => 'Failed to create ingredient. Please try again later.'], 500);
        }
    }

    public function edit($id)
    {
        try {
            $ingredient = Ingredient::findOrFail($id);
            return response()->json($ingredient);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to find the ingredient. Please try again later.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'ingredients' => 'required|string|max:255',
                'recipe_id' => 'required|integer|exists:recipes,id',
                'type' => 'required|string|max:100',
            ]);

            $ingredient = Ingredient::findOrFail($id);
            $ingredient->update($validatedData);

            return response()->json(['message' => 'Ingredient updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update ingredient. Please try again later.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->delete();

            return response()->json(['message' => 'Ingredient deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete ingredient. Please try again later.'], 500);
        }
    }
}
