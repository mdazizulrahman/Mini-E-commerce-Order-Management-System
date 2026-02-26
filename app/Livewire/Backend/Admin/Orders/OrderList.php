<?php

namespace App\Livewire\Backend\Admin\Orders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderList extends Component
{
    use WithPagination;

    public function updateStatus($orderId, $status)
    {
        DB::table('orders')->where('id', $orderId)->update(['status' => $status]);
        session()->flash('message', 'Order status updated successfully.');
    }

    public function render()
    {
        return view('livewire.backend.admin.orders.order-list', [
            'orders' => DB::table('orders')->paginate(10)
        ]);
    }
}
