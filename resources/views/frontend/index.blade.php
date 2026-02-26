<@extends('frontend.layouts.app')

@section('content')

     <div class="container">
        <h1>Welcome to Our E-commerce Store</h1>
        <p>Discover our wide range of products and enjoy a seamless shopping experience.</p>
        <a href="" class="btn btn-primary">Shop Now</a>
    </div>
<div class="max-w-7xl mx-auto ">
    <h1 class="text-3xl font-bold mb-6">Our Products</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        @forelse($products as $product)
            <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                <h2 class="font-semibold text-lg">
                    {{ $product->name }}
                </h2>

                <p class="text-sm text-gray-500">
                    Category: {{ $product->category->name }}
                </p>

                
               <p class="text-sm text-gray-600">
    
</p>

@if($product->avatar)
    <img src="{{ asset('storage/' . $product->avatar) }}" width="300" class="rounded">
@else
    <span>No Image</span>
@endif

<p>Price: ৳{{ $product->price }}</p>
<p>Discount: {{ $product->discount }}%</p>
<p>Final Price: ৳{{ $product->price * (1 - $product->discount / 100) }}</p>



                <p class="text-sm py-2 text-gray-600">
                    Stock: {{ $product->stock }}
                </p>

                <a href="{{ route('frontend.details', ['id' => $product->id, 'slug' => Str::slug($product->name)]) }}"
                   class="w-40 px-20  py-3 bg-black text-white rounded hover:bg-gray-800 transition">
                    order Now
                </a>
            </div>
        @empty
            <p>No products available</p>
        @endforelse
    </div>
</div>

    
@endsection