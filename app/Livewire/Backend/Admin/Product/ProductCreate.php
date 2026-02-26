<?php

namespace App\Livewire\Backend\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $price = 0;
    public $stock = 0;
    public $category_id;
    public $discount = 0;
    public $avatar;
    public $status = 1;

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'discount' => 'nullable|numeric|min:0|max:100', // 0–100%
        'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'status' => 'required|boolean',
    ];

    // Computed property for live final price
    public function getFinalPriceProperty()
    {
        return $this->price * (1 - ($this->discount ?? 0) / 100);
        
    }

    // Save product
    public function save()
    {
        $this->validate();

        // Store image safely
        $imagePath = $this->avatar->store('products', 'public');
        // Save to database
        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'discount' => $this->discount, // saved as % 
            'avatar' => $imagePath,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Product created successfully');

        return redirect()->route('admin.product.product-list');
    }

    // Render view
    public function render()
    {
        return view('livewire.backend.admin.product.product-create', [
            'categories' => Category::all(),
        ]);
    }
}
