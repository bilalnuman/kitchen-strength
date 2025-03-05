<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Validation rules
            $validated = $request->validate([
                'comment' => 'required|string',
                'user_id' => 'required|integer|exists:users,id',
                'recipe_id' => 'required|integer|exists:recipes,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ]);

            // Variables for storing file paths
            $imagePath = null;

            // Handle image (Image) Upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Define the destination path for image (images)
                $destinationPath = public_path('assets/upload/images');

                // Create the directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Generate a unique file name and move the image image
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move($destinationPath, $imageName);
                $imagePath = 'assets/upload/images/' . $imageName;
            }


            // Create and save the comment
            $comment = new Comment();
            $comment->comment = $validated['comment'];
            $comment->user_id = $validated['user_id'];
            $comment->recipe_id = $validated['recipe_id'];
            $comment->image_url = $imagePath;
            $comment->save();

            // Return a response with the saved comment
            return response()->json([
                'message' => 'Comment saved successfully!',
                'comment' => $comment,
            ], 201);
        } catch (\Exception $e) {
            dd($e);
            // Handle errors and exceptions
            return response()->json([
                'error' => 'An error occurred while saving the comment.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
