<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $products = CategoryModel::paginate(20);
        return view('addMore', compact('products'));
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            "name" => "required",
            "stocks" => "required|array|min:1", // Ensure stocks is an array and contains at least one item
        ];

        foreach ($request->stocks as $key => $value) {
            $rules["stocks.{$key}.quantity"] = "required|integer|min:1"; // Ensure quantity is a positive integer
            $rules["stocks.{$key}.price"] = "required|numeric|min:0"; // Ensure price is a non-negative number
        }

        // Validate the request
        $request->validate($rules);

        // Create the category
        $product = CategoryModel::create(["name" => $request->name]);

        // Attach stocks to the category
        foreach ($request->stocks as $value) {
            $product->stocks()->create([
                'quantity' => $value['quantity'],
                'price' => $value['price'],
            ]);
        }

        // Redirect back with success message
        return redirect()->back()->with(['success' => 'Category Successfully Created.']);
    }

}
