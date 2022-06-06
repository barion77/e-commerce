<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function generate_slug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function store_category()
    {   
        $this->validate([
            'name' => 'required',
            'slug' => 'required:unique:categories',
        ]);

        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;

        $category->save();
        
        session()->flash('message_success', 'Category has been created success!');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.default');
    }
}
