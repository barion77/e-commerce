<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddHomeSlideComponent extends Component
{
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;

    public function mount()
    {
        $this->status = 0;
    }

    public function create_slide()
    {
        $this->validate([
            'title' => 'required|min:5|max:36',
            'subtitle' => 'required|max:26',
            'price' => 'required',
            'link' => 'required',
            'image' => 'required|file',
            'status' => 'required',
        ]);

        $slider = new HomeSlider();
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        $image_name = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('sliders', $image_name);
        $slider->image = $image_name;
        $slider->status = $this->status;
        $slider->save();
        session()->flash('message_success', 'Slide has been created successfully!');
    }

    use WithFileUploads;
    public function render()
    {
        return view('livewire.admin.admin-add-home-slide-component')->layout('layouts.default');;
    }
}
