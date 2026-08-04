<?php

namespace App\Livewire\Admin\About;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\AboutSection;

#[Layout('components.layouts.admin')]
#[Title('Form Tentang Kami - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public $itemId = null;
    public $title = '';
    public $subtitle = '';
    public $description = '';
    public $vision = '';
    public $mission = '';
    public $image;
    public $existing_image = null;
    public $years_experience = 0;
    public $is_active = true;
    public $isEditing = false;

    public function mount($about = null)
    {
        if ($about) {
            $this->isEditing = true;
            $about = AboutSection::findOrFail($about);
            $this->itemId = $about->id;
            $this->title = $about->title;
            $this->subtitle = $about->subtitle;
            $this->description = $about->description;
            $this->vision = $about->vision;
            $this->mission = $about->mission;
            $this->existing_image = $about->image;
            $this->years_experience = $about->years_experience;
            $this->is_active = $about->is_active;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'years_experience' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($this->isEditing) {
            $item = AboutSection::findOrFail($this->itemId);
        } else {
            $item = new AboutSection();
        }

        $item->title = $this->title;
        $item->subtitle = $this->subtitle;
        $item->description = $this->description;
        $item->vision = $this->vision;
        $item->mission = $this->mission;
        $item->years_experience = $this->years_experience;
        $item->is_active = $this->is_active;

        if ($this->image) {
            $item->image = $this->image->store('about', 'public');
        }

        $item->save();

        session()->flash('success', $this->isEditing ? 'Tentang kami berhasil diperbarui.' : 'Tentang kami berhasil ditambahkan.');
        return $this->redirect(route('admin.about.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.about.form');
    }
}
