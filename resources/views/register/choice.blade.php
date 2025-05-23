<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pilih Daftar</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-200 to-cyan-500 min-h-screen flex items-center justify-center p-6">
  <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-xl max-w-md w-full p-8 text-center">
    <h1 class="text-3xl font-bold mb-6 text-blue-700">Pilih Jenis Registrasi</h1>
    <div class="flex flex-col gap-4">
      <a href="{{ route('register.mahasiswa') }}" class="bg-blue-600 text-white py-3 rounded hover:bg-blue-700 transition">Daftar Mahasiswa</a>
      <a href="{{ route('register.dosen') }}" class="bg-cyan-600 text-white py-3 rounded hover:bg-cyan-700 transition">Daftar Dosen</a>
      <a href="{{ route('login') }}" class="mt-4 text-sm text-blue-600 hover:underline">Kembali ke Login</a>
    </div>
  </div>
</body>
</html>
