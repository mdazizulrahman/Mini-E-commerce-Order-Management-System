<div>
    {{-- It is never too late to be what you might have been. - George Eliot --}}
    <div class="p-6 max-w-xl">
    <form wire:submit.prevent="save" class="space-y-4">

        <input wire:model="name" placeholder="Product Name" class="w-full border p-2">
        <input wire:model="price" type="number" placeholder="Price" class="w-full border p-2">
        <input wire:model="stock" type="number" placeholder="Stock" class="w-full border p-2">

        <select wire:model="category_id" class="w-full border p-2">
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <button class="bg-black text-white px-4 py-2 rounded">
            Save Product
        </button>
    </form>
</div>

</div>
