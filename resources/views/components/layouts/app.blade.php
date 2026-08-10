@php
    use App\Models\Setting;
    $companyName = Setting::getCompanyName();
    $seoTitle = Setting::getSeoTitle() ?: $companyName . ' | Creative Digital Printing & Branding Agency';
    $seoDescription = Setting::getSeoDescription() ?: Setting::getDescription();
    $seoKeywords = Setting::getSeoKeywords();
    $faviconUrl = Setting::getFaviconUrl();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? $seoTitle }}</title>
    @if($seoDescription)
        <meta name="description" content="{{ $seoDescription }}">
    @endif
    @if($seoKeywords)
        <meta name="keywords" content="{{ $seoKeywords }}">
    @endif
    @if($faviconUrl)
        <link rel="icon" href="{{ $faviconUrl }}" sizes="any">
    @else
        <link rel="icon" href="/favicon.ico" sizes="any">
    @endif
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-light font-inter text-ink antialiased selection:bg-gold/25 selection:text-navy">
    <div class="min-h-screen">
        <livewire:navbar />
        <main>
            {{ $slot }}
        </main>
        <livewire:footer />
    </div>
    @livewireScripts
</body>
</html>
