<!-- resources/views/components/layouts/ar-layout.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'حجز الفندق' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [dir="rtl"] .rtl-font {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 rtl-font">
    <main class="container mx-auto p-4 md:p-10">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>