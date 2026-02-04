<?php

namespace App\Livewire\Backend\Admin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
class ProductList extends Component
{
      use WithPagination;



    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully');
    }

    public function render()
    {
        return view('livewire.backend.admin.product.product-list', [
            'products' => Product::with('category')->paginate(10),
        ]);
    }
}
