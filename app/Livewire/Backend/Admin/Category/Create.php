<?php

namespace App\Livewire\Backend\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $active = 1; 

    protected $rules = [
        'name' => 'required|min:3|unique:categories,name',
        'active' => 'required|boolean',
    ];

    public function store()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name), 
            'active' => $this->active,
        ]);

        session()->flash('message', 'Category created successfully!');

        return redirect()->route('admin.category.index'); 
    }

    public function render()
    {
        return view('livewire.backend.admin.category.create');
    }
}