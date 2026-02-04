<?php

namespace App\Livewire\Backend\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $categoryId;
    public $name;
    public $active;

    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->active = $category->active;
    }

    
    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|unique:categories,name,' . $this->categoryId,
            'active' => 'required|boolean',
        ]);

        $category = Category::find($this->categoryId);
        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'active' => $this->active,
        ]);

        session()->flash('message', 'Category updated successfully.');

        return redirect()->route('admin.category.index');
    }

    public function render()
    {
        return view('livewire.backend.admin.category.edit');
    }
}