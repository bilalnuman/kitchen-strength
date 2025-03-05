<?php

namespace App\Http\Controllers;

use App\Models\ShoppingItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShoppingController extends Controller
{
    public function store(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'ingredient_id' => 'required|array',
            'ingredient_id.*' => 'integer|exists:ingredients,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user_id=Auth::user()->id;

            $res = null;

            foreach ($request->ingredient_id as $ingredientId) {
                $shoppingItem = new ShoppingItem();
                $shoppingItem->user_id = $user_id;
                $shoppingItem->ingredient_id = $ingredientId;
                $res = $shoppingItem->save();
            }

            if ($res) {
                return response()->json(['message' => 'Items added successfully.'], 201);
            } else {
                return response()->json(['error' => 'Failed to add items. Please try again later.'], 500);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add items. Please try again later.');
        }
    }

    public function delete($id)
    {
        try {
            if ($id !== 'null') {
                $item = ShoppingItem::where('user_id', Auth::user()->id)
                    ->where('ingredient_id', $id)
                    ->delete();
            } else {
                $item = ShoppingItem::where('user_id', Auth::user()->id)
                    ->delete();
            }

            if ($item > 0) {
                return response()->json(['success' => true, 'message' => 'Item(s) deleted successfully.'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'No item(s) found to delete.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function index()
    {
        try {
            $items = ShoppingItem::where('user_id', Auth::user()->id)
                ->select('ingredient_id')
                ->with(['ingredient' => function ($query) {
                    $query->select('id', 'unit', 'ingredient', 'type');
                }])
                ->get();
            $groupedItems = $items->groupBy(function ($item) {
                return $item->ingredient->type;
            });
            $formattedItems = $groupedItems->map(function ($group) {
                return $group->map(function ($item) {
                    return [
                        'id' => $item->ingredient->id,
                        'unit' => $item->ingredient->unit,
                        'ingredient' => $item->ingredient->ingredient,
                    ];
                });
            });

            // return $formattedItems;

            return view('web.shopping.index', ['data' => $formattedItems]);
        } catch (\Exception $e) {
         
            return response()->json(['error' => 'Failed to retrieve shopping items. Please try again later.'], 500);
        }
    }
}
