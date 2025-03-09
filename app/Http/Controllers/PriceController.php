<?php

namespace App\Http\Controllers;

use App\Models\PlanPrice;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PriceController extends Controller
{
    // Display a listing of the prices
    public function index()
    {
        $prices = PlanPrice::orderBy('price','desc')->get();
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
       
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'sub_title' => 'required|string|max:255',
                'plan_detail' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'currency' => 'nullable|string|max:3',
            ]);

            // Attempt to create the price record in the database
            $price = PlanPrice::create([
                'title' => $validatedData['title'],
                'payment_type' => $validatedData['payment_type'],
                'amount' => $validatedData['amount'],
                'currency' => $validatedData['currency'] ?? 'USD', // Default to USD if currency is not provided
            ]);

            return redirect()->route('prices.index')->with('success', 'Price added successfully.');
        } catch (ValidationException $e) {
            return $e;
            // If validation fails, the catch block will return to the previous page with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // General exception handler (if something else fails)
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // Display the specified price
    public function show($id)
    {
        $price = PlanPrice::findOrFail($id);
        return view('admin.prices.show', compact('price'));
    }

    // Show the form for editing the specified price
    public function edit($id)
    {
        $price = PlanPrice::findOrFail($id);
        return view('admin.prices.edit', compact('price'));
    }

    // Update the specified price in the database
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'amount' => 'required|numeric|min:0',
                'currency' => 'nullable|string|max:3',
            ]);

            $price = PlanPrice::findOrFail($id);
            $price->update([
                'amount' => $validatedData['amount'],
                'currency' => $validatedData['currency'] ?? $price->currency, // Keep the existing currency if not updated
            ]);

            return redirect()->route('prices.index')->with('success', 'Price updated successfully.');
        } catch (ValidationException $e) {
            // If validation fails, return to the form with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // General exception handler (if something else fails)
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // Remove the specified price from the database
    public function destroy($id)
    {
        try {
            $price = PlanPrice::findOrFail($id);
            $price->delete();

            return redirect()->route('prices.index')->with('success', 'Price deleted successfully.');
        } catch (\Exception $e) {
            // General exception handler (if something else fails)
            return redirect()->route('prices.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
