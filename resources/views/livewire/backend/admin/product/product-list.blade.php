<div>
    {{-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison --}}
    <div class="p-6">
    <a href="{{ route('admin.product.product-create') }}"
       class="bg-black text-white px-4 py-2 rounded">
        + Add Product
    </a>

    <table class="w-full mt-6 border">
        <thead>
            <tr class="bg-gray-100">
                <th>Name</th>
                <th>Category</th>
                <th>avatar</th>
                <th>discount</th>
                <th>Price</th>
                <th>Final Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
@foreach($products as $product)
    <tr class="border-b">
        <td class="p-2">{{ $product->name }}</td>

        <td class="p-2">
            {{ $product->category->name ?? 'No Category' }}
        </td>

        <td class="p-2">
            @if($product->avatar)
                <img src="{{ asset('storage/' . $product->avatar) }}" 
                     width="60" 
                     class="rounded">
            @else
                No Image
            @endif
        </td>

        <td class="p-2">{{ $product->discount ?? 0 }}</td>

        <td class="p-2">৳{{ $product->price }}</td>
        <td class="p-2">
                ৳{{ number_format($product->price * (1 - ($product->discount ?? 0) / 100), 2) }}
            </td>

        <td class="p-2">{{ $product->stock }}</td>

        <td class="p-2">
            <button wire:click="toggleStatus({{ $product->id }})"
                class="px-2 py-1 rounded text-white 
                {{ $product->status ? 'bg-green-500' : 'bg-red-500' }}">
                {{ $product->status ? 'Active' : 'Inactive' }}
            </button>
        </td>

        <td class="p-2">
            <a href="{{ route('admin.product.product-edit', $product->id) }}" 
               class="text-blue-600">
               Edit
            </a>
            |
            <button wire:click="delete({{ $product->id }})"
                class="text-red-600">
                Delete
            </button>
        </td>
    </tr>
@endforeach
</tbody>
    </table>

    {{ $products->links() }}
</div>

</div>
