@include('User_interface.parts.header')

<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-indigo-600 via-cyan-500 to-teal-400 animate-gradient-x">

  @if (session('error'))
  <div class="absolute top-5 bg-red-500 text-white p-4 rounded-lg shadow-lg">
    {{ session('error') }}
  </div>
  @endif

  <div class="w-full max-w-md bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 text-white">
    <h2 class="text-3xl font-bold text-center mb-6">Welcome Back 👋</h2>

    <form action="{{ route('login')}}" method="POST" class="space-y-5">
      @csrf

      @if (session('success'))
      <div class="bg-green-500/80 text-white p-3 rounded-lg text-center">
        {{ session('success') }}
      </div>
      @endif

      @if ($errors->any())
      <div class="bg-red-500/80 text-white p-3 rounded-lg">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div>
        <label for="email" class="block mb-2 text-sm font-semibold">Email Address</label>
        <input type="email" id="email" name="email" required
          class="w-full px-4 py-3 rounded-xl bg-white/20 text-white placeholder-gray-200 focus:ring-2 focus:ring-cyan-400 focus:outline-none">
      </div>

      <div>
        <label for="password" class="block mb-2 text-sm font-semibold">Password</label>
        <input type="password" id="password" name="password" required
          class="w-full px-4 py-3 rounded-xl bg-white/20 text-white placeholder-gray-200 focus:ring-2 focus:ring-cyan-400 focus:outline-none">
      </div>

      <button type="submit"
        class="w-full py-3 bg-cyan-500 hover:bg-cyan-600 rounded-xl font-semibold transition-all duration-300">
        Login
      </button>
    </form>
  </div>

  <script>

    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'gradient-x': 'gradient-x 8s ease infinite',
          },
          keyframes: {
            'gradient-x': {
              '0%, 100%': {
                'background-position': '0% 50%'
              },
              '50%': {
                'background-position': '100% 50%'
              },
            },
          },
        },
      },
    }
  </script>

</body>

</html>