<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-5">

        <!-- Name -->
        <div>
            <label class="block font-medium mb-1">Product Name</label>
            <input type="text" wire:model="name"
                class="w-full border rounded px-3 py-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Price -->
        <div>
            <label class="block font-medium mb-1">Price</label>
            <input type="number" step="0.01" wire:model="price"
                class="w-full border rounded px-3 py-2">
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Stock -->
        <div>
            <label class="block font-medium mb-1">Stock</label>
            <input type="number" wire:model="stock"
                class="w-full border rounded px-3 py-2">
            @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Category -->
        <div>
            <label class="block font-medium mb-1">Category</label>
            <select wire:model="category_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block font-medium mb-1">Status</label>
            <select wire:model="status" class="w-full border rounded px-3 py-2">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Button -->
        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Update Product
            </button>
        </div>
 


    </form>
</div>
