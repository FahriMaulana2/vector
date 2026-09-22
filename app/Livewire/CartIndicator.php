<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIndicator extends Component
{
    #[On('cart-updated')]
    public function refreshCart(): void
    {
        // Re-renders component when cart session is updated
    }

    public function render(CartService $cartService)
    {
        return view('livewire.cart-indicator', [
            'count' => $cartService->count(),
            'subtotal' => $cartService->getSubtotal(),
            'items' => $cartService->getItems(),
        ]);
    }
}
