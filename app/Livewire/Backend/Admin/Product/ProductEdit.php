<?php

namespace App\Livewire\Backend\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;
    public Product $product;

    public $name, $price, $stock, $category_id, $discount, $avatar, $status = 1;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'discount' => 'required|numeric',

        ];
    }


    public function mount(Product $product)
    {

        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->discount = $product->discount;
        $this->avatar = $product->avatar;
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
            'avatar'      => $this->avatar,
            'discount'    => $this->discount,
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
