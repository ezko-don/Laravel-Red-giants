<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        
        $order->load('orderItems.product');
        return view('customer.orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Your cart is empty!');
        }

        // Check stock availability
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()->route('customer.cart.index')
                    ->with('error', "Insufficient stock for {$item->product->name}");
            }
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('customer.orders.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $order = DB::transaction(function () use ($cartItems) {
            // Calculate total
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
            ]);

            // Create order items and update stock
            foreach ($cartItems as $item) {
                // Check stock one more time
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception("Insufficient stock for {$item->product->name}");
                }

                // Create order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Reduce stock
                $item->product->decreaseStock($item->quantity);
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();
            
            return $order;
        });

        // Redirect to order success page showing order summary/ID
        return redirect()->route('customer.orders.show', $order)
            ->with('success', "Order #{$order->id} placed successfully! Your order is being processed.");
    }

    public function cancel(Order $order)
    {
        $this->authorize('cancel', $order);

        DB::transaction(function () use ($order) {
            // Restore stock for all order items
            foreach ($order->orderItems as $item) {
                $product = $item->product;
                $product->increment('stock', $item->quantity);
            }

            // Update order status
            $order->update(['status' => 'cancelled']);
        });

        return redirect()->route('customer.orders.show', $order)
            ->with('success', "Order #{$order->id} has been cancelled successfully. Stock has been restored.");
    }
}
