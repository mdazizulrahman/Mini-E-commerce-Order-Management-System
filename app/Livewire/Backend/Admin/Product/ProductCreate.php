<?php

namespace App\Livewire\Backend\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\category;
class ProductCreate extends Component
{
    public $name, $price, $stock, $category_id, $status = 1;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'status' => 'required|boolean',
    ];
    
    public function save(){
        $this->validate();
        
        Product::create($this->all());

        session()->flash('message', 'Product created successfully');
      return redirect()->route('admin.product.product-list');
    }


    public function render()
    {
        return view('livewire.backend.admin.product.product-create',[
            'categories' => category::all(),
        ]);
    }
}
