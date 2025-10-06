<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
        
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        // Default quantity to 1 if not provided
        $quantity = $request->input('quantity', 1);
        
        $request->merge(['quantity' => $quantity]);
        
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        // Check if product is in stock
        if ($product->stock < 1) {
            $errorMessage = 'Product is out of stock.';
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 400);
            }
            
            return redirect()->back()
                ->with('error', $errorMessage);
        }

        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $quantity;
            if ($newQuantity > $product->stock) {
                $errorMessage = 'Not enough stock available. Only ' . ($product->stock - $existingCartItem->quantity) . ' items can be added.';
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $errorMessage
                    ], 400);
                }
                
                return redirect()->back()
                    ->with('error', $errorMessage);
            }
            $existingCartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        $successMessage = $product->name . ' added to cart successfully!';

        // Check if this is an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage
            ]);
        }

        return redirect()->back()
            ->with('success', $successMessage);
    }

    public function update(Request $request, Cart $cart)
    {
        $this->authorize('update', $cart);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock,
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('customer.cart.index')
            ->with('success', 'Cart updated successfully!');
    }

    public function remove(Cart $cart)
    {
        $this->authorize('delete', $cart);
        
        $cart->delete();

        return redirect()->route('customer.cart.index')
            ->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('customer.cart.index')
            ->with('success', 'Cart cleared successfully!');
    }
}
