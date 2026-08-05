<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Hero;

use App\Models\HeroSection;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Hero Section - Admin OMH Vector')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($id)
    {
        $hero = HeroSection::findOrFail($id);
        $hero->delete();

        session()->flash('success', 'Hero section berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.hero.index', [
            'heroes' => HeroSection::with('statistics')
                ->when(
                    $this->search,
                    fn ($q) => $q->where(
                        'title',
                        'like',
                        '%' . $this->search . '%'
                    )
                )
                ->orderBy('created_at', 'desc')
                ->paginate(10),
        ]);
    }
}