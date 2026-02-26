<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Checkout page
    public function checkout($id, $quantity)
    {
        $product = Product::findOrFail($id);
        return view('frontend.checkout', compact('product', 'quantity'));
    }

    // Confirm Order
    public function confirmOrder(Request $request)
    {
        // Validate input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Calculate final price per unit (discount aware)
        $discount = $product->discount ?? 0;
        $finalUnitPrice = $product->price * (1 - $discount / 100);

        // Total price = final unit price * quantity
        $totalAmount = $finalUnitPrice * $request->quantity;

        DB::transaction(function () use ($request, $product, $finalUnitPrice, $totalAmount) {

            // Create Order
            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            // Create Order Item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $finalUnitPrice, // discount applied
            ]);

            // Decrease product stock
            $product->decrement('stock', $request->quantity);
        });

        return redirect()->to('/')->with('success', 'Your order was successful!');
    }
}
