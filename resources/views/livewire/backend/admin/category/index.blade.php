<div>

        {{-- category-index.blade.php --}}
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Categories</h2>
        <a href="{{ route('admin.category.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
           + Add Category
        </a>
    </div>

    @if(session('message'))
        <p class="text-green-600 mb-3">{{ session('message') }}</p>
    @endif

    <table class="w-full border">
        <tr class="bg-gray-100">
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

@foreach($categories as $cat)
<tr class="border">
    <td>{{ $loop->iteration }}</td>
    <td>{{ $cat->name }}</td>
    <td>
        <button wire:click="toggleStatus({{ $cat->id }})" 
                class="px-2 py-1 rounded text-white {{ $cat->active ? 'bg-green-500' : 'bg-red-500' }}">
            {{ $cat->active ? 'Active' : 'Inactive' }}
        </button>
    </td>
    <td class="space-x-2">
        <a href="{{ route('admin.category.edit', $cat->id) }}" class="text-blue-600">Edit</a>
        
        <button wire:click="delete({{ $cat->id }})"
                class="text-red-600 hover:text-red-800 rounded px-2 py-1"
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
            Delete
        </button>
    </td>
</tr>
@endforeach
    </table>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>

    
    {{-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Maria Skłodowska-Curie --}}
</div>
