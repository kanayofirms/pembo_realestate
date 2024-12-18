<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCartModel;
use Str;

class ProductCartController extends Controller
{

    public function index()
    {
        $products = ProductCartModel::all();
        return view('product_cart.products', compact('products'));
    }

    public function cart()
    {
        return view('product_cart.cart');
    }

    public function admin_product_cart(Request $request)
    {
        $getRecord = ProductCartModel::orderBy('id', 'desc');

        // Search Start
        if (!empty($request->id)) {
            $getRecord = $getRecord->where('product_cart.id', '=', $request->id);
        }

        if (!empty($request->name)) {
            $getRecord = $getRecord->where('product_cart.name', 'like', '%' . $request->name . '%');
        }

        if (!empty($request->price)) {
            $getRecord = $getRecord->where('product_cart.price', 'like', '%' . $request->price . '%');
        }

        if (!empty($request->created_at)) {
            $getRecord = $getRecord->where('product_cart.created_at', 'like', '%' . $request->created_at . '%');
        }

        if (!empty($request->updated_at)) {
            $getRecord = $getRecord->where('product_cart.updated_at', 'like', '%' . $request->updated_at . '%');
        }

        $getRecord = $getRecord->paginate(40);
        $data['getRecord'] = $getRecord;
        return view('admin.product_cart.list', $data);
    }

    public function admin_product_add()
    {
        return view('admin.product_cart.add');
    }

    public function admin_product_store(Request $request)
    {
        $save = new ProductCartModel;
        $save->name = trim($request->name);
        $save->description = trim($request->description);
        $save->price = trim($request->price);

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('product/', $filename);
            $save->image = $filename;
        }
        $save->save();
        return redirect('admin/product_cart')->with('success', "Product Successfully Added!");
    }

    public function admin_product_edit($id)
    {
        $data['getRecord'] = ProductCartModel::find($id);
        return view('admin.product_cart.edit', $data);
    }

    public function admin_product_update($id, Request $request)
    {
        $save = ProductCartModel::find($id);
        $save->name = trim($request->name);
        $save->description = trim($request->description);
        $save->price = trim($request->price);

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('product/', $filename);
            $save->image = $filename;
        }
        $save->save();
        return redirect('admin/product_cart')->with('success', "Product Successfully Updated!");
    }

    public function admin_product_delete($id)
    {
        $recordDelete = ProductCartModel::find($id);
        $recordDelete->delete();

        return redirect('admin/product_cart')->with('success', "Product Successfully Deleted From Cart.");
    }

    public function addToCart($id)
    {
        $product = ProductCartModel::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', "Product Successfully Added to Cart.");
    }
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Get the cart from the session
        $cart = session()->get('cart');

        // Check if the cart exists and the item is in the cart
        if ($cart && isset($cart[$request->id])) {
            // Update the quantity of the product in the cart
            $cart[$request->id]["quantity"] = $request->quantity;

            // Save the updated cart back to the session
            session()->put('cart', $cart);

            // Flash a success message
            session()->flash('success', "Cart Successfully Updated.");

            // Return success response (useful for AJAX or APIs)
            return response()->json(['success' => 'Cart successfully updated.']);
        }

        // If the item does not exist, return an error
        return response()->json(['error' => 'Invalid cart item.'], 404);
    }

    public function remove(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Get the cart from the session
        $cart = session()->get('cart');

        // Check if the cart item exists
        if (isset($cart[$request->id])) {
            // Remove the item from the cart
            unset($cart[$request->id]);

            // Update the session with the modified cart
            session()->put('cart', $cart);

            // Flash a success message
            session()->flash('success', "Product Successfully Removed from cart.");

            // Return success response
            return response()->json([
                'success' => 'Product successfully removed from cart.',
                'cart' => $cart, // Optional: You can return the updated cart here
            ]);
        }

        // If the item does not exist, return an error response
        return response()->json(['error' => 'Item not found in cart.'], 404);
    }


}
