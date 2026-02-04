<?php

namespace App\Livewire\Backend\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductEdit extends Component
{
    public Product $product;

    public $name, $price, $stock, $category_id, $status = 1;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
        ];
    }


    public function mount(Product $product)
    {
      
        $this->product = $product;

        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->status = $product->status;
    }

    public function update()
    {
        $this->validate();

        $this->product->update([
            'name'        => $this->name,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'category_id' => $this->category_id,
            'status'      => $this->status,
        ]);

        session()->flash('message', 'Product updated successfully ');

        return redirect()->route('admin.product.product-list');
    }

    public function render()
    {
        return view('livewire.backend.admin.product.product-edit', [
            'categories' => Category::all(),
        ]);
    }
}
