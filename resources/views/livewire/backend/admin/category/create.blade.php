<div>
    {{-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama --}}
  <div>
    <div class="p-6 max-w-xl mx-auto bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-bold mb-4">Create Category</h2>

        <div class="mb-4">
            <label class="block mb-1">Category Name</label>
            <input wire:model="name"
                   type="text"
                   class="w-full border p-2 rounded"
                   placeholder="Enter category name">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1">Status</label>
            <select wire:model="active" class="w-full border p-2 rounded">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
            @error('active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button wire:click="store"
                wire:loading.attr="disabled"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
            <span wire:loading.remove>Save Category</span>
            <span wire:loading>Saving...</span>
        </button>
    </div>
</div>

</div>
