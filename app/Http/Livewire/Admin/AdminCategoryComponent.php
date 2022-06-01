<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('success_message', 'Category has been deleted successfully!');
    }

    use WithPagination;
    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component', [
            'categories' => $categories,
        ])->layout('layouts.default');
    }
}
