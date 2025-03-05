<?php

namespace App\Http\Controllers;

use App\Models\Nutrition;
use Illuminate\Http\Request;

class NutritionController extends Controller
{
    public function index($recipeId)
    {
        try {
            $recipe = Nutrition::findOrFail($recipeId);
            $methods = $recipe->methods;
            return view('recipe_methods.index', compact('methods', 'recipe'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Recipe not found.'], 404);
        }
    }

    public function create($recipeId)
    {
        return view('recipe_methods.create', compact('recipeId'));
    }

    public function store(Request $request)
    {


        try {
            $request->validate([
                'title' => 'required|string',
                'unit_weight' => 'required|string',
                'recipe_id' => 'required|integer',
            ]);

            Nutrition::create($request->all());
            return response()->json(['message' => 'Nutrition added successfully.']);
            // return redirect()->route('recipe_methods.index')->with('success', 'Method added successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add Nutrition. Please try again later.'], 500);
        }
    }

    public function edit($recipeId, $id)
    {
        try {
            $method = Nutrition::findOrFail($id);
            return view('recipe_methods.edit', compact('method', 'recipeId'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Method not found.'], 404);
        }
    }

    public function update(Request $request, $recipeId, $id)
    {
        try {
            $request->validate([
                'step_number' => 'required|integer',
                'instruction' => 'required|string',
            ]);

            $method = Nutrition::findOrFail($id);
            $method->update([
                'step_number' => $request->step_number,
                'instruction' => $request->instruction,
            ]);

            return redirect()->route('recipe_methods.index', $recipeId)->with('success', 'Method updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update method. Please try again later.'], 500);
        }
    }

    public function destroy($recipeId, $id)
    {
        try {
            $method = Nutrition::findOrFail($id);
            $method->delete();

            return redirect()->route('recipe_methods.index', $recipeId)->with('success', 'Method deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete method. Please try again later.'], 500);
        }
    }
}
