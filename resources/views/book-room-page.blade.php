<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>حجز الغرفة</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

    <div class="container mx-auto py-10">
        @livewire('book-room', ['room' => $roomId])
    </div>

    @livewireScripts
</body>
</html>
