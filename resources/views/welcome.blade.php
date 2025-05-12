<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 font-sans p-10">

  <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 space-y-6">

    <h1 class="text-4xl font-bold text-blue-600 text-center">مرحبا بك في Tailwind CSS</h1>

    <p class="text-lg leading-relaxed">
      هذا نص تجريبي باستخدام تنسيقات Tailwind CSS. يمكنك الآن التأكد أن التنسيق يعمل بشكل صحيح.
    </p>

    <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full shadow-md transition">
      زر تجريبي
    </button>

    <input type="text" placeholder="أدخل شيئًا هنا"
      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

    <div class="grid grid-cols-2 gap-4">
      <div class="bg-blue-100 p-4 rounded-lg text-center">صندوق 1</div>
      <div class="bg-yellow-100 p-4 rounded-lg text-center">صندوق 2</div>
    </div>

  </div>

</body>
</html>
