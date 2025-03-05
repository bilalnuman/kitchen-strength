<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use File;

class RecipeController extends Controller
{
    public function dashboardRecipe()
    {
        try {
            $recipes = Recipe::all();
            return view('admin.recipe.index', compact('recipes'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve recipes. Please try again later.'], 500);
        }
    }
    public function index()
    {
        try {
            $recipes = Recipe::all();
            return view('recipes.index', compact('recipes'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve recipes. Please try again later.'], 500);
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
        return view('admin.recipe.create');
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
            $recipe = Recipe::with(['ingredients', 'methods', 'comments', 'categories'])->findOrFail($id);
            return response()->json($recipe);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
    }

    public function store(Request $request)
    {


        try {
            // Validate the incoming request data
            $validated = $this->handleValidation($request);

            // Handle file uploads for store action
            $filePaths = $this->handleFileUploads($request);


            // Create a new recipe

            $recipe = new Recipe([
                ...$validated,
                'thumbnail' => $filePaths['thumbnail'],
                'video_url' => $filePaths['video'],
            ]);
            $recipe->save();
            return response()->json([
                'message' => 'Recipe created successfully 123456.',
                'recipe' => $recipe,
            ], 201);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'error' => 'Failed to create recipe. Please try again later.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request data
            $validated = $this->handleValidation($request, true);

            // Find the existing recipe
            $recipe = Recipe::findOrFail($id);

            // Handle file uploads for the update action
            $filePaths = $this->handleFileUploads($request, $recipe);

            // Delete old files if new ones are uploaded
            if (!empty($request->thumbnail) && $recipe->thumbnail) {
                $this->deleteFile(public_path($recipe->thumbnail)); // Delete old thumbnail
            }
            if (!empty($request->video) && $recipe->video_url) {
                $this->deleteFile(public_path($recipe->video_url)); // Delete old video
            }

            // Update the recipe with the new data
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
        // Initialize file paths
        $thumbnailPath = $recipe ? $recipe->thumbnail : null; // Keep current path if updating
        $videoPath = $recipe ? $recipe->video_url : null;     // Keep current path if updating

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $destinationPath = public_path('assets/upload/thumbnails');

            // Create directory if it doesn't exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Generate a unique file name and move the file
            $thumbnailName = time() . '-' . $thumbnail->getClientOriginalName();
            $thumbnail->move($destinationPath, $thumbnailName);
            $thumbnailPath = 'assets/upload/thumbnails/' . $thumbnailName; // Update path
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $destinationPath = public_path('assets/upload/videos');

            // Create directory if it doesn't exist
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Generate a unique file name and move the file
            $videoName = time() . '-' . urlencode($video->getClientOriginalName());
            $video->move($destinationPath, $videoName);

            // Save the video path (relative to the 'public' directory)
            $videoPath = 'assets/upload/videos/' . $videoName;
        }


        return [
            'thumbnail' => $thumbnailPath,
            'video' => $videoPath,
        ];
    }
    private function handleValidation($request, $isUpdate = false)
    {
        dd($request->all());
        $rules = [
            'title' => 'required|string|max:255',
            'prep_time' => 'required|string',
            'cook_time' => 'required|string',
            'description' => 'required|string',
            'dish_id' => 'required|integer|exists:dishes,id',
            'diet_id' => 'required|integer|exists:diets,id',
            'method_id' => 'required|integer|exists:methods,id',
            'course_id' => 'required|integer|exists:courses,id',
        ];

        if (!$isUpdate) {
            $rules['thumbnail'] = 'required|image|mimes:png,jpg,jpeg|max:2048';
            $rules['video'] = 'required|mimes:mp4,avi,mov,wmv,mkv|max:10240';
        } else {
            $rules['thumbnail'] = 'nullable|image|mimes:png,jpg,jpeg|max:2048';
            $rules['video'] = 'nullable|mimes:mp4,avi,mov,wmv,mkv|max:10240';
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
