@props([
    'title' => '',
    'value' => '0',
    'icon' => '',
    'color' => 'primary',
    'trend' => null
])

@php
    $colorClasses = [
        'primary' => 'bg-primary/10 text-primary',
        'yellow' => 'bg-accent/20 text-accent-dark',
        'green' => 'bg-emerald-50 text-emerald-600',
        'red' => 'bg-red-50 text-red-600',
        'blue' => 'bg-blue-50 text-blue-600',
        'purple' => 'bg-purple-50 text-purple-600',
    ];
    $iconBg = $colorClasses[$color] ?? $colorClasses['primary'];
@endphp

<div class="group bg-white p-6 rounded-2xl border border-border shadow-soft hover:shadow-card-hover transition-all duration-300 hover:-translate-y-0.5">
    <div class="flex items-center justify-between">
        <div class="space-y-1.5">
            <p class="text-sm font-medium text-text-secondary">{{ $title }}</p>
            <p class="text-3xl font-bold text-text-primary admin-heading">{{ $value }}</p>
            @if($trend)
                <p class="text-xs text-emerald-600 flex items-center gap-1 font-medium">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    {{ $trend }}
                </p>
            @endif
        </div>
        <div class="flex items-center justify-center w-12 h-12 rounded-xl {{ $iconBg }} group-hover:scale-110 transition-transform duration-300">
            {!! $icon !!}
        </div>
    </div>
</div>
