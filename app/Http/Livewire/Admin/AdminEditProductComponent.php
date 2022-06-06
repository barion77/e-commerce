<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AdminEditProductComponent extends Component
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
    public $new_image;
    public $product_id;

    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->product_description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->SKU;
        $this->quantity = $product->quantity;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
        $this->product_id = $product->id;
    }

    public function generate_slug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function update_product()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required|min:10|max:255',
            'description' => 'required|min:10|max:510',
            'regular_price' => 'required|integer',
            'sale_price' => 'integer',
            'sku' => 'required',
            'quantity' => 'required|integer',
            'category_id' => 'required|integer',
        ]);
        
        $product = Product::find($this->product_id);
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
        if ($this->new_image)
        {
            $image_name = Carbon::now()->timestamp . '.' . $this->new_image->extension();
            $this->new_image->storeAs('products', $image_name);
            $product->image = $image_name;
        }
        $product->save();
        session()->flash('message_success', 'Product has been updated successfully!');
    }

    use WithFileUploads;
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-edit-product-component', [
            'categories' => $categories,
        ])->layout('layouts.default');
    }
}
