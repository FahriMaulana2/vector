<?php

declare(strict_types=1);

namespace App\Models;

class BusinessSetting
{
    private static ?self $instance = null;

    /**
     * Get singleton instance for API compatibility with BusinessSetting::getCached().
     */
    public static function getCached(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Resolve fallback contact based on priority:
     * 1. WhatsApp
     * 2. Phone
     * 3. Email
     * 4. None
     *
     * @return array{type: string|null, value: string|null}
     */
    public function getFallbackContact(): array
    {
        $whatsapp = Setting::getWhatsAppNumber();
        if (! empty($whatsapp)) {
            return ['type' => 'whatsapp', 'value' => $whatsapp];
        }

        $phone = Setting::getPhone();
        if (! empty($phone)) {
            return ['type' => 'phone', 'value' => $phone];
        }

        $email = Setting::getEmail();
        if (! empty($email)) {
            return ['type' => 'email', 'value' => $email];
        }

        return ['type' => null, 'value' => null];
    }

    public function hasFallbackContact(): bool
    {
        return $this->getFallbackContact()['type'] !== null;
    }

    /**
     * Get WhatsApp URL using existing Setting::getWhatsAppLink().
     */
    public function getWhatsAppUrl(?string $customMessage = null): ?string
    {
        $link = Setting::getWhatsAppLink($customMessage);

        return $link !== '#' ? $link : null;
    }
}
