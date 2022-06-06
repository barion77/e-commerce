<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use Livewire\Component;

class AdminSaleComponent extends Component
{
    public $sale_date;
    public $status;

    public function mount()
    {
        $sale = Sale::find(1);
        $this->sale_date = $sale->sale_date;
        $this->status = $sale->status;
    }

    public function update_sale()
    {
        $this->validate([
            'sale_date' => 'required',
            'status' => 'required',
        ]);

        $sale = Sale::find(1);
        $sale->sale_date = $this->sale_date;
        $sale->status = $this->status;
        $sale->save();

        session()->flash('message_success', 'Record has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-sale-component')->layout('layouts.default');
    }
}
