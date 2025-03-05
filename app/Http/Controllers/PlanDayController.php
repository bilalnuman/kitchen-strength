<?php

namespace App\Http\Controllers;

use App\Models\PlanDay;
use App\Models\PlanDayRecipe;
use Illuminate\Http\Request;

class PlanDayController extends Controller
{
    public function store(Request $request)
    {
        $request['plan_id'] = $request->plan_day_id;
        try {
            $request->validate([
                'plan_id' => 'required|exists:plans,id',
                'day' => 'nullable|string|max:255',
            ]);

            $planday = PlanDay::create(['plan_id' => $request->plan_id]);
            return response()->json([
                'success' => true,
                'message' => 'Plan day added successfully',
                'id' => $planday->id
            ]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Failed to add plan day. Please try again later.'], 500);
        }
    }

    public function delete($id)
    {
        try {
            $planDay = PlanDay::findOrFail($id);
            $planDay->delete();

            return response()->json(['message' => 'Plan day deleted successfully.']);
        } catch (\Exception $e) {
            return $e;
            return response()->json(['error' => 'Failed to delete plan day. Please try again later.'], 500);
        }
    }
}
