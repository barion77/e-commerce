<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminAddProductComponent extends Component
{
    public $name;
    public $slug;
    public $short_description;
    public $product_description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $quantity;
    public $stock_status;
    public $featured;
    public $image;
    public $category_id;

    public function mount()
    {
        $this->stock_status = 'instock';
        $this->featured = 0;
    }

    public function generate_slug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function create_product()
    {
        if (Product::where('slug', $this->slug)->count() > 0)
        {
            session()->flash('message_error', 'Such a product already exists!');
            return false;
        }

        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->product_description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->sku = $this->sku;
        $product->quantity = $this->quantity;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->category_id = $this->category_id;
        $image_name = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('products', $image_name);
        $product->image = $image_name;
        $product->save();
        session()->flash('message_success', 'Product has been created successfully!');
    }

    use WithFileUploads;
    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.admin-add-product-component', [
            'categories' => $categories,
        ])->layout('layouts.default');
    }
}
