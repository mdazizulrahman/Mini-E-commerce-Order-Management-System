<div>
    {{-- An unexamined life is not worth living. - Socrates --}}
    <div>
    <div class="p-6 max-w-xl mx-auto bg-white shadow rounded">
        <h2 class="text-xl font-bold mb-4">Edit Category</h2>

        <input wire:model="name"
               class="w-full border p-2 mb-3"
               placeholder="Category Name">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <select wire:model="active" class="w-full border p-2 mb-4">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
        @error('active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button wire:click="update" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Category
        </button>
    </div>
</div>

</div>
