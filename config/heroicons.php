<?php

declare(strict_types=1);

/**
 * Curated Heroicons mapping used across the app.
 *
 * Each key is a short identifier stored in the database (e.g. 'printer').
 * The value contains a human friendly name and SVG inner markup (one or more <path> elements)
 * which will be rendered inside an <svg> element with outline style attributes.
 */

return [
    'icons' => [
        'chat-bubble-left' => [
            'name' => 'Chat Bubble',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />',
        ],
        'pencil' => [
            'name' => 'Pencil',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />',
        ],
        'printer' => [
            'name' => 'Printer',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />',
        ],
        'truck' => [
            'name' => 'Truck',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 7h13v10H3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16 14h1a2 2 0 012 2v1" />',
        ],
        'check' => [
            'name' => 'Check',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />',
        ],
        'clock' => [
            'name' => 'Clock',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 22a10 10 0 100-20 10 10 0 000 20z" />',
        ],
        'document-text' => [
            'name' => 'Document',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10M7 11h10M7 15h6" /><path stroke-linecap="round" stroke-linejoin="round" d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h6l6 6v10a2 2 0 01-2 2z" />',
        ],
        'clipboard-document' => [
            'name' => 'Clipboard Document',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 2h6v2H9z" /><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10v12H7z" />',
        ],
        'building-office' => [
            'name' => 'Office Building',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" /><path stroke-linecap="round" stroke-linejoin="round" d="M7 21V7h10v14" />',
        ],
        'shopping-bag' => [
            'name' => 'Shopping Bag',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6 2l1 4h10l1-4" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6z" />',
        ],
        'cube' => [
            'name' => 'Cube',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8l-9-5-9 5v8l9 5 9-5z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18" />',
        ],
        'package' => [
            'name' => 'Package',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8l-9-5-9 5v8l9 5 9-5z" />',
        ],
        'phone' => [
            'name' => 'Phone',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.6a1 1 0 01.97.757l.547 2.188a1 1 0 01-.217.87L7.4 9.6a11.042 11.042 0 005 5l2.869-1.1a1 1 0 01.87-.217L19.243 14.4A1 1 0 0120 15.37V18a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" />',
        ],
        'envelope' => [
            'name' => 'Envelope',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l8.5 6L20 8" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 8v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8" />',
        ],
        'globe-alt' => [
            'name' => 'Globe',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2 12a10 10 0 1020 0A10 10 0 002 12z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 2v20M2 12h20" />',
        ],
        'sparkles' => [
            'name' => 'Sparkles',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 12l2 2 4-4" />',
        ],
        'star' => [
            'name' => 'Star',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.1 6.46a1 1 0 00.95.69h6.8c.969 0 1.371 1.24.588 1.81l-5.6 4.05a1 1 0 00-.364 1.118l2.1 6.46c.3.921-.755 1.688-1.538 1.118L12 18.347l-5.6 4.05c-.783.57-1.838-.197-1.538-1.118l2.1-6.46a1 1 0 00-.364-1.118L1.998 11.887c-.783-.57-.38-1.81.588-1.81h6.8a1 1 0 00.95-.69l2.1-6.46z" />',
        ],
        'shield-check' => [
            'name' => 'Shield Check',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V7l-8-4-8 4v5c0 6 8 10 8 10z" />',
        ],
        'cog-6-tooth' => [
            'name' => 'Cog',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 15.5A3.5 3.5 0 1112 8.5a3.5 3.5 0 010 7z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06A2 2 0 014.27 16.9l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09c.7 0 1.28-.39 1.51-1a1.65 1.65 0 00-.33-1.82L4.27 4.27A2 2 0 017.1 1.44l.06.06a1.65 1.65 0 001.82.33h.09C9.11 2 9.69 1.61 10.4 1.61H13.6c.71 0 1.29.39 1.51 1a1.65 1.65 0 001.82.33l.06-.06A2 2 0 0119.73 4.27l-.06.06c-.37.37-.55.9-.33 1.41.16.38.47.7.88.88.51.22.99.22 1.41-.11l.06-.06A2 2 0 0121.73 7.1l-.06.06a1.65 1.65 0 00-.33 1.82c.22.71.61 1.29 1.22 1.51V11a2 2 0 010 4h-.09c-.7 0-1.28.39-1.51 1z" />',
        ],
        'magnifying-glass' => [
            'name' => 'Search',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" /><path stroke-linecap="round" stroke-linejoin="round" d="M11 19a8 8 0 100-16 8 8 0 000 16z" />',
        ],
        'photo' => [
            'name' => 'Photo',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4z" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 12l2 2 3-3 5 5" />',
        ],
        'paint-brush' => [
            'name' => 'Paint Brush',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536" /><path stroke-linecap="round" stroke-linejoin="round" d="M4 21c4-1 6-3 7-7" />',
        ],
        'wrench' => [
            'name' => 'Wrench',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232L19 9" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 21l6-6" />',
        ],
        'check-circle' => [
            'name' => 'Check Circle',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 22a10 10 0 100-20 10 10 0 000 20z" />',
        ],
        'arrow-path' => [
            'name' => 'Arrow Path',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 3v6h6" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 21v-6h-6" />',
        ],
        'calendar-days' => [
            'name' => 'Calendar',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3M16 7V3" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 8h18v11a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />',
        ],
        'credit-card' => [
            'name' => 'Credit Card',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18v10H3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 11h18" />',
        ],
        'banknotes' => [
            'name' => 'Banknotes',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8" /><path stroke-linecap="round" stroke-linejoin="round" d="M20 7H4v10h16V7z" />',
        ],
        'document-check' => [
            'name' => 'Document Check',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 7h10M7 11h4" /><path stroke-linecap="round" stroke-linejoin="round" d="M17 21H7a2 2 0 01-2-2V5a2 2 0 012-2h6l6 6v10a2 2 0 01-2 2z" />',
        ],
        'computer-desktop' => [
            'name' => 'Computer Desktop',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6" /><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h18v11H3z" />',
        ],
        'rocket-launch' => [
            'name' => 'Rocket Launch',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 2s3 5 6 8 6 6 6 6-3 3-6 0-6-6-8-6-6-6-6-6 6 0 8 2z" />',
        ],
        'light-bulb' => [
            'name' => 'Light Bulb',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 18h6" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 2a7 7 0 00-4 12v2h8v-2a7 7 0 00-4-12z" />',
        ],
    ],
];
