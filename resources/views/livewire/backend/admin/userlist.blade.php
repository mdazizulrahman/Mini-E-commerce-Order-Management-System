<div>
    {{-- He who is contented is rich. - Laozi --}}
    <div class="p-6">
    <di`v class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">User List (Total: {{ $users->total() }})</h2>
        
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 font-semibold">Name</th>
                    <th class="p-3 font-semibold">Email</th>
                    <th class="p-3 font-semibold">Role</th>
                    <th class="p-3 font-semibold">Status</th>
                    <th class="p-3 font-semibold">Joined At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3 text-capitalize">
                        <span class="px-2 py-1 rounded text-xs {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="p-3">
                        @if($user->active)
                            <span class="text-green-600 flex items-center">● Active</span>
                        @else
                            <span class="text-red-600 flex items-center">● Inactive</span>
                        @endif
                    </td>
                    <td class="p-3 text-gray-500 text-sm">
                        {{ $user->created_at->format('d M, Y') }}
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }} </div>
</div>
</div>
