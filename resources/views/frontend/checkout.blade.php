@extends('frontend.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow mt-10 rounded">
    <h2 class="text-2xl font-bold mb-6">Confirm Your Order</h2>

    @if($product->avatar)
                <img src="{{ asset('storage/' . $product->avatar) }}" width="600px" height="300px" class="rounded">
            @else
                <span>No Image</span>
            @endif

    <form action="{{ route('order.confirm') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Customer Info --}}
            <div class="space-y-4">
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div>
                    <label>Your Name</label>
                    <input type="text" name="customer_name" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label>Mobile number</label>
                    <input type="text" name="phone" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label>Your Address</label>
                    <textarea name="address" class="w-full border p-2 rounded" required></textarea>
                </div>

                <div>
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="{{ $quantity ?? 1 }}" class="w-full border p-2 rounded" required>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="bg-gray-50 p-4 mt-10 rounded border">
                <h3 class="font-bold border-b pb-2 mb-2">Order Summary</h3>

                @php
                    $qty = $quantity ?? 1;
                    $discount = $product->discount ?? 0;
                    $finalUnitPrice = $product->price * (1 - $discount / 100);
                    $totalPrice = $finalUnitPrice * $qty;
                @endphp

                <p>Product: {{ $product->name }}</p>
                <p>Quantity: {{ $qty }}</p>
                <p>Price: ৳{{ number_format($product->price, 2) }}</p>
                <p>Discount: {{ $discount }}%</p>
                <p>Price After Discount: ৳{{ number_format($finalUnitPrice, 2) }}</p>
                <p class="text-xl font-bold mt-4">Total: ৳{{ number_format($totalPrice, 2) }}</p>

                <button type="submit" class="w-full bg-orange-600 text-white py-3 mt-6 rounded font-bold hover:bg-orange-700">
                    Confirm Order
                </button>
            </div>
        </div>
    </form>
</div>
@endsection