<?php

namespace App\Http\Controllers;

use App\Models\PlanPrice;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PriceController extends Controller
{
    // Display a listing of the prices
    public function planPrice()
    {
        $plans = PlanPrice::orderBy('price', 'asc')->get();
        return view('web.plans.index', compact('plans'));
    }
    public function index()
    {
        $prices = PlanPrice::orderBy('price', 'desc')->get();
        return view('admin.prices.index', compact('prices'));
    }

    // Show the form for creating a new price
    public function create()
    {
        return view('admin.prices.create');
    }

    // Store a newly created price in the database


    public function store(Request $request)
    {
        return $this->handleDatabaseOperation(function () use ($request) {
            $validatedData = $this->validateRequest($request);

            $res = PlanPrice::create($validatedData);

            if ($res) {
                return redirect()->route('prices.index')->with('success', 'Price added successfully.');
            }

            return redirect()->back()->with('error', 'Failed to add price.');
        });
    }

    public function show($id)
    {
        $price = $this->findPriceOrFail($id);
        return view('admin.prices.show', compact('price'));
    }

    // Show the form for editing the specified price
    public function edit($id)
    {

        $price = $this->findPriceOrFail($id);
        return view('admin.prices.edit', compact('price'));
    }

    // Update the specified price in the database
    public function update(Request $request, $id)
    {


        return $this->handleDatabaseOperation(function () use ($request, $id) {
            $validatedData = $this->validateRequest($request, true);
            $price = $this->findPriceOrFail($id);
            $price->update($validatedData);

            return redirect()->route('prices.index')->with('success', 'Price updated successfully.');
        });
    }

    // Remove the specified price from the database
    public function destroy($id)
    {
        return $this->handleDatabaseOperation(function () use ($id) {
            $price = $this->findPriceOrFail($id);
            $price->delete();
            return redirect()->route('prices.index')->with('success', 'Price deleted successfully.');
        });
    }

    /**
     * Validate request data.
     */
    private function validateRequest(Request $request, $isUpdate = false)
    {
        return $request->validate([
            'title' => $isUpdate ? 'sometimes|string' : 'required|string',
            'sub_title' => $isUpdate ? 'sometimes|string' : 'required|string',
            'plan_detail' => $isUpdate ? 'sometimes|string' : 'required|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:3',
        ]);
    }

    /**
     * Find a price record or fail.
     */
    private function findPriceOrFail($id)
    {
        return PlanPrice::findOrFail($id);
    }

    /**
     * Handle database operations with error handling.
     */
    private function handleDatabaseOperation(callable $operation)
    {
        try {
            return $operation();
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}