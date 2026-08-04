<?php

namespace App\Livewire\Admin\Testimonials;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Testimonial;

#[Layout('components.layouts.admin')]
#[Title('Form Testimoni - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;
    public $name = '';
    public $position = '';
    public $company = '';
    public $message = '';
    public $rating = 5;
    public $photo;
    public $existing_photo = null;
    public $is_featured = false;
    public $is_active = true;
    public $isEditing = false;

    public function mount($testimonial = null)
    {
        if ($testimonial) {
            $this->isEditing = true;
            $item = Testimonial::findOrFail($testimonial);
            $this->itemId = $item->id;
            $this->name = $item->name;
            $this->position = $item->position;
            $this->company = $item->company;
            $this->message = $item->message;
            $this->rating = $item->rating;
            $this->existing_photo = $item->photo;
            $this->is_featured = $item->is_featured;
            $this->is_active = $item->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'photo' => 'nullable|image|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $item = $this->isEditing ? Testimonial::findOrFail($this->itemId) : new Testimonial();
        $item->name = $this->name;
        $item->position = $this->position;
        $item->company = $this->company;
        $item->message = $this->message;
        $item->rating = $this->rating;
        $item->is_featured = $this->is_featured;
        $item->is_active = $this->is_active;

        if ($this->photo) {
            $item->photo = $this->photo->store('testimonials', 'public');
        }

        $item->save();

        session()->flash('success', $this->isEditing ? 'Testimoni berhasil diperbarui.' : 'Testimoni berhasil ditambahkan.');
        return $this->redirect(route('admin.testimonials.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.testimonials.form');
    }
}
