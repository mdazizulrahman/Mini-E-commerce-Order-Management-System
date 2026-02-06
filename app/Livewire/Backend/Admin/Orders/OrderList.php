<?php

namespace App\Livewire\Backend\Admin\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class OrderList extends Component
{
    use WithPagination;

    public function updateStatus($orderId, $status)
    {
        $order = Order::findOrFail($orderId);
        $order->status = $status;
        $order->save();

        session()->flash('message', 'Order status updated successfully ');
    }

    public function render()
    {
        return view('livewire.backend.admin.orders.order-list', [
            'orders' => Order::with('user')->latest()->paginate(10),
        ]);
    }
}
