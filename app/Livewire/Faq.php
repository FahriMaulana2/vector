<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Faq as FaqModel;

class Faq extends Component
{
    public function render()
    {
        $faqs = FaqModel::active()->get();

        return view('livewire.faq', compact('faqs'));
    }
}
