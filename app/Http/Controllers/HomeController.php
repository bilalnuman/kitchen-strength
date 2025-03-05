<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Method;
use App\Models\Recipe;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // return redirect()->route('recipes.index');
        try {
            $recipes = Recipe::orderBy('created_at', 'desc')->get();
            $banners = Banner::first();

            $categories = Dish::with([
                'recipes' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])->whereIn('name', ['spicy', 'quick meals'])->get();

            $dinnerRecipes = $categories->firstWhere('name', 'spicy');
            $sweetRecipes = $categories->firstWhere('name', 'quick meals');
            // dd( $dinnerRecipes);

            return view('home', compact('recipes', 'dinnerRecipes', 'sweetRecipes', 'banners'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

}
