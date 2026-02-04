<?php

namespace App\Livewire\Backend\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
     use WithPagination;

    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
      
        $category->update([
            'active' => !$category->active 
        ]);
        
        session()->flash('message', 'Status updated successfully');
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        session()->flash('message', 'Category deleted successfully');
    }

    public function render()
    {
        return view('livewire.backend.admin.category.index', [
            'categories' => Category::paginate(10),
        ]);
    }
}