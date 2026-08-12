<?php

namespace App\Livewire;

use App\Models\Faq as FaqModel;
use App\Models\Setting;
use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        $faqs = FaqModel::active()->get();
        $whatsappLink = Setting::getWhatsAppLink();

        return view('livewire.faq', compact('faqs', 'whatsappLink'));
    }
}
