<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        try {
            $plans = Plan::with([
                'days' => function ($query) {
                    $query->whereHas('recipes') // Ensure the day has at least one recipe
                        ->select('id', 'plan_id')
                        ->limit(3);
                },
                'days.recipes' => function ($query) {
                    $query->select('thumbnail', 'recipes.id')->limit(1);
                }
            ])->get();

            $plans->each(function ($plan) {
                $plan->days->each(function ($day) {
                    $day->recipe = $day->recipes->first(); // Assign only the first recipe
                    unset($day->recipes); // Remove the array
                });
            });

            // return response()->json($plans);

            return view('plans.index', compact('plans'));
        } catch (\Exception $e) {
            return $e;
            return response()->json(['error' => 'Failed to retrieve plans. Please try again later.'], 500);
        }
    }
    public function mealPlan()
    {
        try {
            $plans = Plan::where('user_id', Auth::user()->id)->with('days.recipes')->get();
            // return $plans;
            return view('plans.meal-plan', compact('plans'));
        } catch (\Exception $e) {
            return $e;
            return response()->json(['error' => 'Failed to retrieve plans. Please try again later.'], 500);
        }
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {

        try {
            $request->validate([
                'title' => 'nullable|string|max:255'
            ]);

            $plane = Plan::create([
                'title' => $request->title ? $request->title : Carbon::now()->format('Y-m-d'),
                'user_id' => Auth::user()->id,
            ]);
            return response()->json(['success' => true, 'message' => 'Plan created successfully', 'plan' => $plane]);
        } catch (\Exception $e) {
            // dd($e->getMessage());   
            return response()->json(['success' => false, 'message' => 'ailed to create plan. Please try again later' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $recipes = Recipe::all();
            $plan = Plan::where('id', $id)->where('user_id', Auth::user()->id)
                ->with([
                    'days' => function ($query) {
                        $query->orderBy('created_at', 'asc');
                    },
                    'days.recipes'
                ])
                ->first();

            // dd($plan);
            return view('plans.plan', compact('plan', 'recipes'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Plan not found.'], 404);
        }
    }
    public function edit($id)
    {
        try {
            $plan = Plan::findOrFail($id);
            return view('plans.edit', compact('plan'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to find the plan. Please try again later.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'user_id' => 'required|integer|exists:users,id',
            ]);

            $plan = Plan::findOrFail($id);
            $plan->update($request->all());

            return redirect()->route('plans.index')->with('success', 'Plan updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update plan. Please try again later.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $plan = Plan::findOrFail($id);
            $plan->delete();

            return redirect()->route('plans.index')->with('success', 'Plan deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete plan. Please try again later.'], 500);
        }
    }
}
