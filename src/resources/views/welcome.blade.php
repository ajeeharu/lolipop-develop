<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-2xl transform hover:scale-105 transition-all duration-300">
        <h1 class="text-4xl font-black text-blue-600 mb-4">
            Tailwind CSS 動作確認！
        </h1>
        <p class="text-gray-600 text-lg">
            この文字が青く、背景がグレーなら成功です。
        </p>
        <button class="mt-6 px-6 py-2 bg-pink-500 text-white font-bold rounded-full hover:bg-pink-600">
            ロリポップへ一歩前進
        </button>
    </div>
</body>
</html>
