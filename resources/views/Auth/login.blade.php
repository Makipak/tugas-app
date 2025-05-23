<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Login</title>
</head>
<body class="bg-gradient-to-br from-gray-200 to-cyan-500 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white/30 backdrop-blur-lg rounded-xl shadow-xl flex flex-col md:flex-row w-full max-w-5xl overflow-hidden">

    <div class="flex-1 bg-white/4 p-8 flex flex-col justify-center items-start text-white">
      <img src="{{ asset('img/faletehan.png') }}" alt="Logo" class="w-20 h-20 object-cover mb-6" />
      <h1 class="text-4xl font-bold mb-2">Halo,</h1>
      <h2 class="text-4xl font-bold mb-4">Selamat Datang!!</h2>
      <p class="text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum non laboriosam provident</p>
    </div>

    <div class="flex-1 bg-white p-8 flex flex-col justify-center">
      <form action="{{ route('login.attempt') }}" method="POST">
        @csrf

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-4">
          <label for="email" class="text-sm text-blue-600 block mb-1">Email address</label>
          <input type="email" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror" required autocomplete="email" autofocus />
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="text-sm text-blue-600 block mb-1">Password</label>
          <div class="relative">
            <input id="password" type="password" name="password" placeholder="Masukkan Password" class="w-full border border-blue-600 rounded px-3 py-2 text-sm text-blue-600 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror" required autocomplete="current-password" />
            <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path id="eyePath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 01-6 0m13.25 0a9.77 9.77 0 01-1.2 2.3m-2.3 2.3A9.77 9.77 0 0112 21.25a9.77 9.77 0 01-2.3-1.2m-2.3-2.3A9.77 9.77 0 012.75 12a9.77 9.77 0 011.2-2.3m2.3-2.3A9.77 9.77 0 0112 2.75a9.77 9.77 0 012.3 1.2m2.3 2.3A9.77 9.77 0 0121.25 12z" />
              </svg>
            </button>
          </div>
          @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex justify-between items-center mb-4 text-sm text-blue-600">
          <label class="flex items-center">
            <input type="checkbox" name="remember" class="mr-2" {{ old('remember') ? 'checked' : '' }} />
            Remember me
          </label>
          <a href="#" class="hover:underline">Forgot Password?</a>
        </div>

        <div class="flex gap-3">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm font-semibold">Login</button>
          <button type="button" onclick="window.location.href='{{  route('register.choice') }}'" class="border border-blue-600 text-blue-600 px-4 py-2 rounded hover:bg-blue-100 text-sm font-semibold">Sign up</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyePath = document.getElementById('eyePath');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyePath.setAttribute('d', 'M13.875 18.825A10.05 10.05 0 0112 19c-4.5 0-8.25-2.625-10.125-6.225a10.168 10.168 0 012.775-3.6m1.95-1.2A9.957 9.957 0 0112 5c4.5 0 8.25 2.625 10.125 6.225a10.166 10.166 0 01-4.875 4.575M15 12a3 3 0 11-6 0 3 3 0 016 0z');
      } else {
        passwordInput.type = 'password';
        eyePath.setAttribute('d', 'M15 12a3 3 0 01-6 0m13.25 0a9.77 9.77 0 01-1.2 2.3m-2.3 2.3A9.77 9.77 0 0112 21.25a9.77 9.77 0 01-2.3-1.2m-2.3-2.3A9.77 9.77 0 012.75 12a9.77 9.77 0 011.2-2.3m2.3-2.3A9.77 9.77 0 0112 2.75a9.77 9.77 0 012.3 1.2m2.3 2.3A9.77 9.77 0 0121.25 12z');
      }
    }
  </script>
</body>
</html>
