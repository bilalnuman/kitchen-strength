<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Diet;
use App\Models\Dish;
use App\Models\Method;
use App\Models\Ingredient;
use App\Models\Nutrition;
use App\Models\Recipe;
use App\Models\RecipeMethod;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function getRecipes()
    {
        try {
            $recipes = Recipe::all();
            return view('recipes.index', compact('recipes'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve recipes. Please try again later.'], 500);
        }
    }

    public function index()
    {
        try {
            $recipes = Recipe::all();
            return view('admin.recipe.index', compact('recipes'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve recipes. Please try again later.'], 500);
        }
    }
    public function cooking($id)
    {
        try {
            $recipe = Recipe::with(['ingredients', 'methods', 'nutrition'])->findOrFail($id);
            return view('recipes.cooking', compact('recipe'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }
    public function search(Request $request)
    {
        try {
            $key = $request->query('key');
            $value = $request->query('value');


            if (is_numeric($value)) {
                $recipes = Recipe::where($key, '=', $value)->get();
            } else {
                $recipes = Recipe::where($key, 'like', '%' . $value . '%')->get();
            }

            return view('recipes.index', compact('recipes'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' => 'Failed to retrieve recipes. Please try again later.'], 500);
        }
    }

    public function create()
    {
        $dishes = Dish::all();
        $diets = Diet::all();
        $courses = Course::all();
        $methods = Method::all();
        return view('admin.recipe.create', compact('dishes', 'diets', 'courses', 'methods'));

    }

    public function edit($id)
    {
        try {
            $recipe = Recipe::findOrFail($id);
            return response()->json($recipe);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Recipe not found.'], 404);
        }
    }

    public function show($id)
    {
        try {
            $recipe = Recipe::with(['ingredients', 'methods', 'comments', 'nutrition'])->findOrFail($id);
            // return response()->json($recipe);
            return view('recipes.detail', compact('recipe'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }


    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            $validated = $this->handleValidation($request);
            $filePaths = $this->handleFileUploads($request);
            $recipe = new Recipe([
                ...$validated,
                'video_url' => $filePaths['video'],
                'thumbnail' => $filePaths['thumbnail'],
            ]);
            $recipe->save();
            $ingredients = array_map(function ($ingredient) use ($recipe) {
                return array_merge($ingredient, ['recipe_id' => $recipe->id]);
            }, $request->ingredients);

            $nutritions = array_map(function ($nutrition) use ($recipe) {
                return array_merge($nutrition, ['recipe_id' => $recipe->id]);
            }, $request->nutritions);
            Ingredient::insert($ingredients);
            Nutrition::insert($nutritions);
            $methods = array_map(function ($method) use ($recipe) {
                if (isset($method['image'])) {
                    $thumbnail = $method['image'];
                    $destinationPath = public_path('assets/upload/images');
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true);
                    }
                    $thumbnailName = time() . '-' . $thumbnail->getClientOriginalName();
                    $thumbnail->move($destinationPath, $thumbnailName);
                    $imagePath = 'assets/upload/images/' . $thumbnailName;
                }

                return array_merge(
                    $method,
                    ['recipe_id' => $recipe->id, 'image' => $imagePath ?? null]
                );
            }, $request->methods);
            RecipeMethod::insert($methods);
            DB::commit();
            return back();

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to create recipe. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $validated = $this->handleValidation($request, true);
            $recipe = Recipe::findOrFail($id);
            $filePaths = $this->handleFileUploads($request, $recipe);
            if (!empty($request->thumbnail) && $recipe->thumbnail) {
                $this->deleteFile(public_path($recipe->thumbnail));
            }
            if (!empty($request->video) && $recipe->video_url) {
                $this->deleteFile(public_path($recipe->video_url));
            }
            $updateData = array_merge($validated, [
                'thumbnail' => $filePaths['thumbnail'] ?? $recipe->thumbnail,
                'video_url' => $filePaths['video'] ?? $recipe->video_url,
            ]);

            $recipe->update($updateData);

            return response()->json([
                'message' => 'Recipe updated successfully.',
                'recipe' => $recipe,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update recipe. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    protected function deleteFile($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    private function handleFileUploads(Request $request, Recipe $recipe = null)
    {
        $thumbnailPath = $recipe ? $recipe->thumbnail : null;
        $videoPath = $recipe ? $recipe->video_url : null;

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail');
            $destinationPath = public_path('assets/upload/thumbnails');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $thumbnailName = time() . '-' . $thumbnail->getClientOriginalName();
            $thumbnail->move($destinationPath, $thumbnailName);
            $thumbnailPath = 'assets/upload/thumbnails/' . $thumbnailName;
        }


        if ($request->hasFile('video')) {
            $video = $request->file('video');

            $destinationPath = public_path('assets/upload/videos');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $videoName = time() . '-' . urlencode($video->getClientOriginalName());
            $video->move($destinationPath, $videoName);
            $videoPath = 'assets/upload/videos/' . $videoName;
        }


        return [
            'thumbnail' => $thumbnailPath,
            'video' => $videoPath,
        ];
    }
    private function handleValidation($request, $isUpdate = false)
    {
        // dd($request->all());
        $rules = [
            'title' => 'required|string|max:255',
            'prep_time' => 'required|string',
            'cook_time' => 'required|string',
            'description' => 'required|string',
            'dish_id' => 'required|integer|exists:dishes,id',
            'diet_id' => 'required|integer|exists:diets,id',
            'method_id' => 'required|integer|exists:methods,id',
            'course_id' => 'required|integer|exists:courses,id',
            'cooking_tips' => 'nullable|string',
            'notes' => 'nullable|string',
            'storage_instructions' => 'nullable|string',
        ];

        if (!$isUpdate) {
            $rules['thumbnail'] = 'required|image|mimes:png,jpg,jpeg|max:120000';
            $rules['video'] = 'required|mimes:mp4,avi,mov,wmv,mkv|max:120000';
        } else {
            $rules['thumbnail'] = 'nullable|image|mimes:png,jpg,jpeg|max:120000';
            $rules['video'] = 'nullable|mimes:mp4,avi,mov,wmv,mkv|max:120000';
        }

        return $request->validate($rules);
    }
    public function destroy($id)
    {
        try {
            $recipe = Recipe::findOrFail($id);
            $recipe->delete();

            return response()->json(['message' => 'Recipe deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete recipe. Please try again later.'], 500);
        }
    }
}
