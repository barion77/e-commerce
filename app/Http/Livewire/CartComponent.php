<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increase_quantity($row_id)
    {
        $product = Cart::get($row_id);
        $qty = $product->qty + 1;
        Cart::update($row_id, $qty);
    }

    public function decrease_quantity($row_id)
    {
        $product = Cart::get($row_id);
        $qty = $product->qty - 1;
        Cart::update($row_id, $qty);
    }

    public function delete($row_id)
    {
        Cart::remove($row_id);
        session()->flash('success_message', 'Item has been removed');
    }

    public function delete_all()
    {
        Cart::destroy();
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.default');
    }
}
