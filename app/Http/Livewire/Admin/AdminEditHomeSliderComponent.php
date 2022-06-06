<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditHomeSliderComponent extends Component
{
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $status;
    public $new_image;
    public $slider_id;

    public function mount($slider_id)
    {
        $slider = HomeSlider::find($slider_id);
        $this->title = $slider->title;
        $this->subtitle = $slider->subtitle;
        $this->price = $slider->price;
        $this->link = $slider->link;
        $this->image = $slider->image;
        $this->status = $slider->status;
        $this->slide_id = $slider->id;
    }

    public function update_slide()
    {
        $this->validate([
            'title' => 'required|min:5|max:36',
            'subtitle' => 'required|max:26',
            'price' => 'required',
            'link' => 'required',
            'image' => 'required|file'
        ]);
        
        $slider = HomeSlider::find($this->slide_id);
        $slider->title = $this->title;
        $slider->subtitle = $this->subtitle;
        $slider->price = $this->price;
        $slider->link = $this->link;
        if ($this->new_image)
        {
            $image_name = Carbon::now()->timestamp . '.' . $this->new_image->extension();
            $this->new_image->storeAs('sliders', $image_name);
            $slider->image = $image_name;
        }
        $slider->status = $this->status;
        $slider->save();

        session()->flash('message_success', 'Slide has been updated successfully!');
    }

    use WithFileUploads;
    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.default');;
    }
}
