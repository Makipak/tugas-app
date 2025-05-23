<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Dosen</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-200 to-cyan-500 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-xl flex flex-col md:flex-row w-full max-w-5xl overflow-hidden">

    <div class="flex-1 bg-white/4 p-8 flex flex-col justify-center items-start text-white">
      <img src="{{ asset('img/faletehan.png') }}" alt="Logo" class="w-20 h-20 object-cover mb-6" />
      <h1 class="text-4xl font-bold mb-2">Daftar Akun</h1>
      <h2 class="text-4xl font-bold mb-4">Dosen</h2>
      <p class="text-base">Isi data diri Anda sebagai dosen untuk membuat akun absensi.</p>
    </div>

    <div class="flex-1 bg-white p-8 flex flex-col justify-center">
      <h3 class="text-2xl font-bold text-blue-600 mb-6 text-center">Registrasi Dosen</h3>

      <form action="{{ route('register.dosen') }}" method="POST">
        @csrf

        <input type="hidden" name="role" value="dosen">

         <div class="mb-4">
          <label for="username" class="text-sm text-blue-600 block mb-1">Username</label>
          <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('username') border-red-500 @enderror"/>
          @error('username')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="email" class="text-sm text-blue-600 block mb-1">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror"/>
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="text-sm text-blue-600 block mb-1">Password</label>
          <input type="password" id="password" name="password" placeholder="Password" required class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror"/>
          @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-6">
          <label for="password_confirmation" class="text-sm text-blue-600 block mb-1">Konfirmasi Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400"/>
        </div>

        <div class="mb-4">
          <label for="nidn" class="text-sm text-blue-600 block mb-1">NIDN</label>
          <input type="text" id="nidn" name="nidn" value="{{ old('nidn') }}" placeholder="NIDN" required class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nidn') border-red-500 @enderror"/>
          @error('nidn')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="nama_lengkap" class="text-sm text-blue-600 block mb-1">Nama Lengkap</label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap" required class="form-control w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('nama_lengkap') border-red-500 @enderror"/>
          @error('nama_lengkap')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="bidang_keahlian" class="text-sm text-blue-600 block mb-1">Bidang Keahlian</label>
          <input type="text" id="bidang_keahlian" name="bidang_keahlian" value="{{ old('bidang_keahlian') }}" placeholder="Bidang Keahlian" required class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('bidang_keahlian') border-red-500 @enderror"/>
          @error('bidang_keahlian')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>


        <div class="flex justify-between items-center">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm font-semibold">Daftar</button>
          <a href="{{ route('login') }}" class="text-blue-600 hover:underline text-sm">Sudah punya akun? Login</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
