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
    public function checkout($id, $quantity) {
        $product = Product::findOrFail($id);
        return view('frontend.checkout', compact('product', 'quantity'));
    }

    public function confirmOrder(Request $request) {
        $request->validate([
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $product = Product::find($request->product_id);

        DB::transaction(function () use ($request, $product) {
        
            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'total_amount' => $product->price * $request->quantity,
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
            ]);

          
            $product->decrement('stock', $request->quantity);
        });

       return redirect()->to('/')->with('success', 'Your order was successful!
');
    }
}
