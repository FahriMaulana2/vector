<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Hero;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\HeroSection;

#[Layout('components.layouts.admin')]
#[Title('Form Hero Section - Admin OMH Vector')]
class Form extends Component
{
    use WithFileUploads;

    public HeroSection $hero;
    public $heroId = null;
    public $title = '';
    public $subtitle = '';
    public $description = '';
    public $button_text = '';
    public $button_link = '';
    public $image;
    public $existing_image = null;
    public $is_active = true;
    public $isEditing = false;

    public function mount($hero = null)
    {
        if ($hero) {
            $this->isEditing = true;
            $this->hero = HeroSection::findOrFail($hero);
            $this->heroId = $this->hero->id;
            $this->title = $this->hero->title;
            $this->subtitle = $this->hero->subtitle;
            $this->description = $this->hero->description;
            $this->button_text = $this->hero->button_text;
            $this->button_link = $this->hero->button_link;
            $this->existing_image = $this->hero->image;
            $this->is_active = $this->hero->is_active;
        } else {
            $this->hero = new HeroSection();
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($this->isEditing) {
            $hero = $this->hero;
        } else {
            $hero = new HeroSection();
        }

        $hero->title = $this->title;
        $hero->subtitle = $this->subtitle;
        $hero->description = $this->description;
        $hero->button_text = $this->button_text;
        $hero->button_link = $this->button_link;
        $hero->is_active = $this->is_active;

        if ($this->image) {
            $hero->image = $this->image->store('hero', 'public');
        }

        $hero->save();

        session()->flash('success', $this->isEditing ? 'Hero section berhasil diperbarui.' : 'Hero section berhasil ditambahkan.');

        return $this->redirect(route('admin.hero.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.hero.form');
    }
}
