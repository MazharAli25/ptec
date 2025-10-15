<header class="flex items-center justify-between p-4 border-b border-gray-200 bg-white shadow-sm">
    <!-- LEFT -->
    <div class="flex items-center gap-3">
        <!-- Sidebar toggle (mobile) -->
        <button id="menu-btn"
            class="md:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
            <svg class="w-6 h-6 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- trainer -->
        <div class="relative">
            <p class="text-[12px] mb-1 text-[#666a85]">Authorized Training Provider</p>
            <h3 class="text-lg text-gray font-bold hidden sm:block mb-0">{{ $user = Auth::guard('super_admin')->user()->name ?? Auth::guard('admin')->user()->institute->institute_name }}</h3>
            <span class="text-[#666a85] text-[20px] mt-1">{{ ucFirst($user = Auth::guard('super_admin')->user()->name ?? Auth::guard('admin')->user()->name) }}</span>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-3">
        <!-- Notifications -->
        <button class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500"
            title="Notifications">
            🔔
        </button>

        <!-- Profile -->
        <div
            class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors duration-200">
            <img src="{{ asset('images/logo.png') }}" alt="avatar"
                class="w-12 h-12 rounded-full object-cover border border-gray-300">
        </div>
    </div>
</header>

<script>
    // Auto remove alerts
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 2000);

    // Sidebar / menu toggle
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }
</script>