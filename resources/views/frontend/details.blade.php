@extends('frontend.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">

    {{-- Success / Error --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Product Info --}}
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>

            <p class="text-gray-500 mb-3">
                Category: {{ $product->category->name }}
            </p>

            @if($product->avatar)
                <img src="{{ asset('storage/' . $product->avatar) }}" width="300" class="rounded">
            @else
                <span>No Image</span>
            @endif

            @php
                $discount = $product->discount ?? 0;
                $finalPrice = $product->price * (1 - $discount / 100);
            @endphp

            <p>Price: ৳{{ number_format($product->price, 2) }}</p>
            <p>Discount: {{ $discount }}%</p>
            <p>Final Price: ৳{{ number_format($finalPrice, 2) }}</p>

            <p class="text-gray-600 mb-4">
                <strong>Stock:</strong>
                @if($product->stock > 0)
                    {{ $product->stock }} items available
                @else
                    <span class="text-red-600">Out of stock</span>
                @endif
            </p>

            <div class="border-t pt-4 mb-6">
                <h3 class="font-semibold mb-2">Description</h3>
                <p class="text-gray-700">
                    {{ $product->description ?? 'No description available.' }}
                </p>
            </div>

            {{-- Order Form --}}
            <form method="GET" action="{{ route('direct.checkout', [$product->id, 1]) }}" id="orderForm">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

               

                <button type="submit" 
                        class="bg-orange-500 text-white px-4 py-2 rounded">
                    Order Now
                </button>
            </form>

            <a href="{{ route('frontend.exampleHosted') }}" 
               class="bg-orange-500 text-white px-4 py-2 rounded mt-4 inline-block">
                View Payment Example
            </a>

        </div>
    </div>
</div>

{{-- Optional JS to dynamically update form action if needed --}}
<script>
    const quantityInput = document.getElementById('quantity');
    const orderForm = document.getElementById('orderForm');

    quantityInput.addEventListener('input', function() {
        const quantity = this.value;
        orderForm.action = `{{ url('direct/checkout/' . $product->id) }}/${quantity}`;
    });
</script>

@endsection