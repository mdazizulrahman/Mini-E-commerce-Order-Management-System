@extends('frontend.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow mt-10 rounded">
    <h2 class="text-2xl font-bold mb-6">Confirm Your Order</h2>
    
    <form action="{{ route('order.confirm') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">
                
                <div>
                    <label>Your Name</label>
                    <input type="text" name="customer_name" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label>Mobile number:</label>
                    <input type="text" name="phone" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label>your Address:</label>
                    <textarea name="address" class="w-full border p-2 rounded" required></textarea>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded border">
                <h3 class="font-bold border-b pb-2 mb-2">Order Summary</h3>
                <p>Product: {{ $product->name }}</p>
                <p>Quantity: {{ $quantity }}</p>
                <p class="text-xl font-bold mt-4">Total: ৳{{ number_format($product->price * $quantity, 2) }}</p>
                
                <button type="submit" class="w-full bg-orange-600 text-white py-3 mt-6 rounded font-bold hover:bg-orange-700">
                    Confirm Order
                </button>
            </div>
        </div>
    </form>
</div>
@endsection