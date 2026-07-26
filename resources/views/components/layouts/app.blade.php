<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'OMH Vector | Creative Digital Printing & Branding Agency' }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#F8FAFC] text-slate-900 antialiased selection:bg-[#0B5ED7]/20 selection:text-slate-900">
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

