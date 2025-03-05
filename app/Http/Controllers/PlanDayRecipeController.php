<?php

namespace App\Http\Controllers;

use App\Models\PlanDayRecipe;
use App\Models\Recipe;
use Illuminate\Http\Request;

class PlanDayRecipeController extends Controller
{

    public function index()
    {
        try {
            $recipe = Recipe::with('planDays')->get();
            dd($recipe);
            $methods = $recipe->methods;
            return view('recipe_methods.index', compact('methods', 'recipe'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Recipe not found.'], 404);
        }
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'plan_day_id' => 'required|exists:plan_days,id',
                'recipe_id' => 'required|exists:recipes,id',
            ]);

            $recipeId = PlanDayRecipe::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Recipe added to day successfully.',
                'id' => $recipeId->id
            ]);
        } catch (\Exception $e) {
            dd($e);
            return $e;
            return response()->json(['error' => 'Failed to add plan day. Please try again later.'], 500);
        }
    }

    public function delete($id)
    {
        try {
            $planDay = PlanDayRecipe::where('id', $id)
                ->first();


            if (!$planDay) {
                return response()->json(['error' => 'Recipe not found.'], 404);
            }

            if ($planDay->delete()) {
                return response()->json(['success' => true, 'message' => 'Recipe deleted successfully.'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to delete recipe. Please try again later.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete recipe. Please try again later.'], 500);
        }
    }
}
