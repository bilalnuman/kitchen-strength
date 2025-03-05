<?php

namespace App\Http\Controllers;

use App\Models\FavouriteRecipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteRecipeController extends Controller
{
    public function getFavouriteRecipes()
    {

        $user_id = Auth::user()->id;
        $user = User::with('favouriteRecipes')->find($user_id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return view('favourites.index', compact('user'));
    }

    public function toggleFavoutire($id)
    {

        $user_id = Auth::user()->id;

        try {
            $favourite = FavouriteRecipe::where('user_id', $user_id)->where('recipe_id', $id)->first();
            if ($favourite) {
                $favourite->delete();
                return response()->json(['message' => 'Item removed from favourites successfully.']);
            }
            FavouriteRecipe::create([
                'user_id' => $user_id,
                'recipe_id' => $id,
            ]);


            return response()->json(['message' => 'Item added to favourites successfully.']);
        } catch (\Exception $e) {
            return $e;
            return response()->json(['error' => 'Something went wrong while adding to favourites. Please try again later.'], 500);
        }
    }
}
