<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Tabungan</title>
    @vite('resources/css/app.css')
</head>
<body class="flex h-screen bg-blue-500 text-gray-800">

    <!-- Sidebar -->
<div class="w-24 bg-white flex flex-col items-center py-6 shadow-lg">
    <!-- Icon User -->
    <div class="flex flex-col items-center mb-8">
        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
            <img src="/icons/user.png" class="w-8 h-8 opacity-80" alt="User Icon">
        </div>
        <p class="text-sm font-semibold mt-2 text-center">Nama User</p>
    </div>

    <!-- Menu -->
    <div class="flex flex-col gap-8 mt-4 text-sm text-center">
        
        <!-- Transaksi -->
        <div class="flex flex-col items-center">
            <img src="/icons/Dompet.png" class="w-8 h-8 mb-1" alt="Transaksi Icon">
            <p>Transaksi</p>
        </div>

        <!-- Home -->
        <div class="flex flex-col items-center text-blue-500">
            <img src="/icons/Home.png" class="w-8 h-8 mb-1" alt="Home Icon">
            <p>Home</p>
        </div>

        <!-- Laporan -->
        <div class="flex flex-col items-center">
            <img src="/icons/data.png" class="w-8 h-8 mb-1" alt="Laporan Icon">
            <p>Laporan</p>
        </div>

        <!-- Nabung -->
        <div class="flex flex-col items-center">
            <img src="/icons/babi.png" class="w-8 h-8 mb-1" alt="Nabung Icon">
            <p>Nabung</p>
        </div>

    </div>
</div>


    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <div class="h-16 bg-white flex items-center px-6 shadow">
            <h1 class="text-xl font-semibold">Nama User</h1>
        </div>

        <!-- Content -->
        <div class="flex-1 flex items-center justify-center relative">
            <div class="bg-gray-300 rounded-xl shadow-lg p-6 w-120 h-40">
                <h2 class="font-bold text-lg mb-3">Tabungan</h2>
                <div class="bg-white rounded-lg p-4 text-center text-2xl font-medium">
                    Rp. 0
                </div>
            </div>

            <!-- Floating Add Button -->
            <a href="{{ url('/add') }}" 
            class="absolute bottom-10 right-10 bg-white rounded-full w-14 h-14 shadow-lg flex items-center justify-center hover:scale-105 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </a>

        </div>
    </div>

</body>
</html>
