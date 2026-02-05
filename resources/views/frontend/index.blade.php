<@extends('frontend.layouts.app')

@section('content')

     <div class="container">
        <h1>Welcome to Our E-commerce Store</h1>
        <p>Discover our wide range of products and enjoy a seamless shopping experience.</p>
        <a href="" class="btn btn-primary">Shop Now</a>
    </div>
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Our Products</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        @forelse($products as $product)
            <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg">
                    {{ $product->name }}
                </h2>

                <p class="text-sm text-gray-500">
                    Category: {{ $product->category->name }}
                </p>

                <p class="text-xl font-bold mt-2">
                    ৳{{ number_format($product->price, 2) }}
                </p>

                <p class="text-sm text-gray-600">
                    Stock: {{ $product->stock }}
                </p>

                <button class="mt-4 w-full bg-black text-white py-2 rounded">
                    Add to Cart
                </button>
            </div>
        @empty
            <p>No products available</p>
        @endforelse
    </div>
</div>

    
@endsection