<div>
    {{-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead --}}
   <div class="p-6">

    <h1 class="text-3xl font-bold mb-6">Orders</h1>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Order ID</th>
                    <th class="px-4 py-3 text-left">Customer</th>
                    <th class="px-4 py-3 text-left">Phone</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Address</th>
                    <th class="px-4 py-3 text-left">Transaction</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Currency</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Created</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach ($orders as $order)
                    <tr>
                        <td class="px-4 py-3">#{{ $order->id }}</td>

                        <td class="px-4 py-3">
                            {{ $order->customer_name ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->phone ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->email ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->address ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->transaction_id ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3 font-bold">
                            ৳ {{ number_format($order->total_amount, 2) }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $order->currency ?? 'BDT' }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded text-white text-sm
                                @if($order->status == 'pending') bg-yellow-500
                                @elseif($order->status == 'processing') bg-blue-500
                                @elseif($order->status == 'completed') bg-green-600
                                @else bg-red-500 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            {{ optional($order->created_at)->format('d M Y') ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3">
                            <select
                                wire:change="updateStatus({{ $order->id }}, $event.target.value)"
                                class="border rounded px-2 py-1 text-sm"
                            >
                                <option value="pending" @selected($order->status=='pending')>Pending</option>
                                <option value="processing" @selected($order->status=='processing')>Processing</option>
                                <option value="completed" @selected($order->status=='completed')>Completed</option>
                                <option value="cancelled" @selected($order->status=='cancelled')>Cancelled</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>

</div>

</div>
