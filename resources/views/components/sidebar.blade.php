<!-- resources/views/components/sidebar.blade.php -->
<aside class="fixed inset-y-0 left-0 z-50 w-64 
    bg-blue-200/90 backdrop-blur-xl
    shadow-[0_4px_30px_rgba(0,0,0,0.15)] 
    border-r border-blue-300
    flex flex-col">
    <div class="flex flex-col h-full">

        <!-- Header Sidebar (Logo + Nama User) -->
        <div class="px-6 py-8 border-b border-gray-100">
            <div class="flex items-center space-x-4">
                <img src="/icons/user.png" class="w-12 h-12 rounded-full ring-4 ring-blue-100" alt="user">
                <div>
                    <p class="font-bold text-gray-800 text-lg">{{ auth()->user()->name }}</p>
                    <a href="{{ route('profile.edit') }}" class="text-xs text-blue-600 hover:underline">
                        Edit Profil →
                    </a>
                </div>
            </div>
        </div>

        <!-- Menu Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2">

            <!-- Home -->
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100' }}
                      flex items-center space-x-4 px-5 py-4 rounded-2xl transition-all duration-300 font-medium">
                <img src="/icons/Home.png" class="w-7 h-7 {{ request()->routeIs('dashboard') ? 'brightness-0 invert' : '' }}">
                <span>Home</span>
            </a>

            <!-- Riwayat Transaksi -->
            <a href="{{ route('riwayat') }}"
               class="{{ request()->routeIs('riwayat') ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100' }}
                      flex items-center space-x-4 px-5 py-4 rounded-2xl transition-all duration-300 font-medium">
                <img src="/icons/Dompet.png" class="w-7 h-7 {{ request()->routeIs('riwayat') ? 'brightness-0 invert' : '' }}">
                <span>Riwayat Transaksi</span>
            </a>

            <!-- Nabung -->
            <a href="{{ route('savings.create') }}"
               class="{{ request()->routeIs('savings.*') ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gray-100' }}
                      flex items-center space-x-4 px-5 py-4 rounded-2xl transition-all duration-300 font-medium">
                <img src="/icons/babi.png" class="w-7 h-7 {{ request()->routeIs('savings.*') ? 'brightness-0 invert' : '' }}">
                <span>Buat Target</span>
            </a>

            
            <!-- Laporan -->
            <a href="{{ route('laporan') }}"
            class="{{ request()->is('laporan*') || request()->routeIs('laporan') 
                        ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-black shadow-lg' 
                        : 'text-grey-700 hover:bg-gray-100' }}
                    flex items-center space-x-4 px-5 py-4 rounded-2xl transition-all duration-300 font-medium">
                
                <img src="/icons/data.png" 
                    class="w-7 h-7 {{ request()->is('laporan*') ? 'brightness-0 invert' : '' }}">
                
                <span>Laporan</span>
            </a>

        </nav>

        <!-- Logout di bawah -->
        <div class="p-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                        class="w-full flex items-center space-x-4 px-5 py-4 text-red-600 hover:bg-red-50 
                               rounded-2xl transition-all duration-300 font-medium">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </div>
</aside>