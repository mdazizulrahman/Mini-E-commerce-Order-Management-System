<div>
    {{-- It is never too late to be what you might have been. - George Eliot --}}
    <div class="p-6 max-w-xl mx-auto">
    {{-- "It is never too late to be what you might have been." - George Eliot --}}
    
    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">

        {{-- Product Name --}}
        <div>
            <input wire:model="name" type="text" placeholder="Product Name" 
                   class="w-full border p-2 rounded">
            @error('name') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Price --}}
        <div>
            <label class="block mb-1">Price (৳)</label>
            <input wire:model="price" type="number" step="0.01" 
                   class="w-full border p-2 rounded">
            @error('price') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Discount --}}
        <div>
            <label class="block mb-1">Discount (%)</label>
            <input wire:model="discount" type="number" step="0.01" 
                   class="w-full border p-2 rounded">
            @error('discount') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Final Price Live Preview --}}
        <div>
            <label class="block mb-1">Final Price (৳)</label>
            <input type="text" value="৳{{ number_format($this->finalPrice, 2) }}" 
                   readonly class="w-full border p-2 rounded bg-gray-100">
        </div>

        {{-- Avatar / Image --}}
        <div>
            <label class="block mb-1">Avatar</label>
            <input wire:model="avatar" type="file" 
                   class="w-full border p-2 rounded">
            @error('avatar') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror

            @if($avatar)
                <img src="{{ $avatar->temporaryUrl() }}" width="80" class="mt-2 rounded">
            @endif
        </div>

        {{-- Stock --}}
        <div>
            <input wire:model="stock" type="number" placeholder="Stock" 
                   class="w-full border p-2 rounded">
            @error('stock') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Category --}}
        <div>
            <select wire:model="category_id" class="w-full border p-2 rounded">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        {{-- Save Button --}}
        <div>
            <button type="submit" class="bg-black text-white px-4 py-2 rounded w-full">
                Save Product
            </button>
        </div>

    </form>
</div>
  
</div>
