<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
  </head>

  <body class="bg-gray-100 text-gray-800 font-sans p-10">

   
    <div class="max-w-4xl mx-auto mt-10">
      @livewire('room-search')
    </div>

    @livewireScripts
  </body>
</html>
