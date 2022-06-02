<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        session()->flash('message_success', 'Product has been deleted successfully!');
    }   

    use WithPagination;
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.admin-product-component', [
            'products' => $products,
        ])->layout('layouts.default');
    }
}
