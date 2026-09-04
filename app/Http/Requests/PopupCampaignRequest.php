<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PopupCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'template_type' => ['required', 'in:hybrid_canva,code_flash_sale,code_welcome'],
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:150'],
            'cta_type' => ['required', 'in:marketplace,whatsapp,custom_url'],
            'marketplace_id' => [
                'required_if:cta_type,marketplace',
                'nullable',
                'integer',
                'exists:marketplaces,id',
            ],
            'cta_url' => [
                'required_if:cta_type,custom_url',
                'nullable',
                'url',
            ],
            'cta_text' => ['required', 'string', 'max:255'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after:starts_at'],
        ];
    }
}
