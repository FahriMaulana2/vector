<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Hero;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;
use App\Models\HeroSection;

#[Layout('components.layouts.admin')]
#[Title('Edit Hero Section')]
class Edit extends Component
{
    use WithFileUploads;

    public HeroSection $hero;

    public $title = '';
    public $subtitle = '';
    public $description = '';
    public $button_text = '';
    public $button_link = '';
    public $image;
    public $existing_image = null;
    public $is_active = true;

    public function mount(HeroSection $hero): void
    {
        $this->hero = $hero;

        $this->title = $hero->title;
        $this->subtitle = $hero->subtitle;
        $this->description = $hero->description;
        $this->button_text = $hero->button_text;
        $this->button_link = $hero->button_link;
        $this->existing_image = $hero->image;
        $this->is_active = (bool) $hero->is_active;
    }

    public function update(): void
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

        $hero = $this->hero;

        $hero->title = $this->title;
        $hero->subtitle = $this->subtitle;
        $hero->description = $this->description;
        $hero->button_text = $this->button_text;
        $hero->button_link = $this->button_link;
        $hero->is_active = $this->is_active;

        // Jika user mengunggah gambar baru
        if ($this->image) {
            // Hapus gambar lama jika ada
            if ($this->existing_image && Storage::disk('public')->exists($this->existing_image)) {
                Storage::disk('public')->delete($this->existing_image);
            }

            // Simpan gambar baru ke storage/app/public/heroes
            $hero->image = $this->image->store('heroes', 'public');
        }

        // Pastikan hanya SATU hero yang aktif
        if ($hero->is_active) {
            HeroSection::where('id', '!=', $hero->id)
                ->update(['is_active' => false]);
        }

        $hero->save();

        session()->flash('success', 'Hero section berhasil diperbarui.');

        $this->redirect(route('admin.hero.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.hero.edit');
    }
}
