<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $course = Course::all();
            return response()->json($course);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve courses. Please try again later.'], 500);
        }
    }

    public function create()
    {
        $courses = Course::all();

        return view('admin.course.create', compact('courses'));
        // return view('admin.course.create');
    }

    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:courses,name',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            Course::create($request->all());

            $courses = Course::all();

            return view('admin.course.create', compact('courses'));

            // return response()->json(['message' => 'Course created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create course. Please try again later.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json($course);
        } catch (\Exception $e) {
            return response()->json(['error' => 'course not found.'], 404);
        }
    }

    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json($course);
        } catch (\Exception $e) {
            return response()->json(['error' => 'course not found.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:courses,name,' . $id,
            ]);

            $course = Course::findOrFail($id);
            $course->update($request->all());

            return response()->json(['message' => 'course updated successfully.']);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to update Course. Please try again later.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            return response()->json(['message' => 'Course deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Course. Please try again later.'], 500);
        }
    }
}
