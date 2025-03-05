<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $banners = Banner::all();
            return response()->json($banners);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve banners. Please try again later.'], 500);
        }
    }

    private function uploadImages(Request $request, $directory = 'thumbnails')
    {
        $imagePaths = [];

        // Check if the images are uploaded
        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');  // Get the array of uploaded images

            foreach ($uploadedImages as $image) {
                // Define the destination path
                $destinationPath = public_path('assets/upload/' . $directory);

                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Generate a unique file name for each image and move the file
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move($destinationPath, $imageName);

                // Store each image path in an array
                $imagePaths[] = 'assets/upload/' . $directory . '/' . $imageName;
            }
        }

        return $imagePaths;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Form for creating a new category.']);
    }



    public function store(Request $request)
    {
        try {
            // Validate the incoming request to ensure that multiple images are required and of valid type
            $validated = $request->validate([
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB file size for each image
            ]);

            // Upload images using the reusable method
            $imagePaths = $this->uploadImages($request);

            // If no images are uploaded, return an error
            if (empty($imagePaths)) {
                return response()->json(['error' => 'No images uploaded'], 400);
            }

            // Save banner data (store image paths in the database)
            foreach ($imagePaths as $imagePath) {
                $banner = new Banner([
                    'thumbnail' => $imagePath,
                    'page' => $request['page'],
                    'link' => $request['link'],
                ]);
                $banner->save();
            }

            return response()->json([
                'message' => 'Images uploaded successfully!',
                'image_paths' => $imagePaths,
            ]);
        } catch (\Exception $e) {
            // Log the exception message for debugging
            Log::error('Image upload failed: ' . $e->getMessage());

            // Return a response with a generic error message
            return response()->json([
                'error' => 'An error occurred while uploading the images. Please try again later.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            return response()->json($banner);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Banner not found.'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            return response()->json($banner);
        } catch (\Exception $e) {
            return response()->json(['error' => 'banner not found.'], 404);
        }
    }



    public function update(Request $request, $id)
    {
        try {
            // Validate the incoming request to ensure that multiple images are required and of valid type
            $validated = $request->validate([
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB file size for each image
            ]);

            // Find the existing banner by ID
            $banner = Banner::findOrFail($id);

            // Check and delete the previous image if it exists
            if ($banner->thumbnail && File::exists(public_path($banner->thumbnail))) {
                // Delete the old image from the storage
                File::delete(public_path($banner->thumbnail));
            }

            // Upload new images (if any)
            $imagePaths = $this->uploadImages($request);

            // If no new images were uploaded, use existing images or return an error
            if (empty($imagePaths) && !$request->has('images')) {
                return response()->json(['error' => 'No images uploaded'], 400);
            }

            // Update the banner with the new image paths
            foreach ($imagePaths as $imagePath) {
                $banner->thumbnail = $imagePath;  // Save the new image path
                $banner->page = $request['page'];
                $banner->link = $request['link'];
                $banner->save();
            }

            return response()->json([
                'message' => 'Banner updated successfully!',
                'image_paths' => $imagePaths,
            ]);
        } catch (\Exception $e) {
            // Log the exception message for debugging
            Log::error('Image update failed: ' . $e->getMessage());

            // Return a response with a generic error message
            return response()->json([
                'error' => 'An error occurred while updating the images. Please try again later.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
