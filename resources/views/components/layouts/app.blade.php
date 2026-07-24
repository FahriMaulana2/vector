<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Printify Studio | Digital Printing Agency' }}</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] text-slate-900 antialiased">
    <div class="min-h-screen">
        <livewire:navbar />
        <main class="overflow-hidden">
            {{ $slot }}
        </main>
        <livewire:footer />
    </div>
    @livewireScripts
</body>
</html>

