<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Halaman Admin</h1>

        <p class="text-gray-700">Selamat datang, {{ Auth::user()->name }}!</p>
        <p class="text-gray-600 mt-2">Ini adalah dashboard admin.</p>
    </div>

</body>
</html>
