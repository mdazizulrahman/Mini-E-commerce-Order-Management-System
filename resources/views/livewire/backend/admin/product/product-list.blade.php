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
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
            <tr class="border-b">
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>৳{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <button wire:click="toggleStatus({{ $product->id }})"
                        class="px-2 py-1 rounded {{ $product->status ? 'bg-green-500' : 'bg-red-500' }} text-white">
                        {{ $product->status ? 'Active' : 'Inactive' }}
                    </button>
                </td>
                <td>
                    <a href="{{ route('admin.product.product-edit', $product->id) }}" class="text-blue-600">Edit</a>
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
