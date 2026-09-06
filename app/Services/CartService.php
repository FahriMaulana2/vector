<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Str;

class CartService
{
    protected const SESSION_KEY = 'omahvector.cart';

    /**
     * Add an item to the cart session and return its generated UUID.
     *
     * @param  array<string, mixed>  $item
     */
    public function addItem(array $item): string
    {
        $items = $this->getItems();
        $uuid = (string) Str::uuid();
        $item['uuid'] = $uuid;

        $items[$uuid] = $item;
        session()->put(self::SESSION_KEY, $items);

        return $uuid;
    }

    /**
     * Update an existing cart item by UUID.
     *
     * @param  array<string, mixed>  $item
     */
    public function updateItem(string $uuid, array $item): bool
    {
        $items = $this->getItems();
        if (! isset($items[$uuid])) {
            return false;
        }

        $item['uuid'] = $uuid;
        $items[$uuid] = $item;
        session()->put(self::SESSION_KEY, $items);

        return true;
    }

    /**
     * Remove an item from the cart by UUID.
     */
    public function removeItem(string $uuid): bool
    {
        $items = $this->getItems();
        if (! isset($items[$uuid])) {
            return false;
        }

        unset($items[$uuid]);
        session()->put(self::SESSION_KEY, $items);

        return true;
    }

    /**
     * Retrieve all items currently in the cart.
     *
     * @return array<string, array<string, mixed>>
     */
    public function getItems(): array
    {
        return session()->get(self::SESSION_KEY, []);
    }

    /**
     * Retrieve a specific cart item by UUID.
     *
     * @return array<string, mixed>|null
     */
    public function getItem(string $uuid): ?array
    {
        $items = $this->getItems();

        return $items[$uuid] ?? null;
    }

    /**
     * Clear all items from the cart.
     */
    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * Get the total subtotal of all items in the cart.
     */
    public function getSubtotal(): float
    {
        $items = $this->getItems();
        $total = 0.0;

        foreach ($items as $item) {
            $total += (float) ($item['line_subtotal'] ?? 0);
        }

        return round($total, 2);
    }

    /**
     * Check if any item in the cart has manual quote flag set to true.
     */
    public function hasManualQuoteItem(): bool
    {
        $items = $this->getItems();

        foreach ($items as $item) {
            if (! empty($item['manual_quote_flag'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Count items in the cart.
     */
    public function count(): int
    {
        return count($this->getItems());
    }
}
