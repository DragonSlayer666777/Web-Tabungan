<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    @vite('resources/css/app.css')
</head>

<body class="flex h-screen bg-[#1D84E4] text-gray-900">

    <!-- Sidebar -->
    <div class="w-24 bg-white flex flex-col items-center py-6 shadow-xl">
        
        <!-- Icon User -->
        <div class="flex flex-col items-center mb-10">
            <img src="/icons/user.png" class="w-8 h-8 opacity-80" alt="">
            <p class="text-sm font-semibold mt-2 text-center">Nama User</p>
        </div>

        <!-- Menu -->
        <div class="flex flex-col gap-10 text-sm text-center mt-6">

            <a href="/transaksi" class="flex flex-col items-center">
                <img src="/icons/Dompet.png" class="w-8 h-8" alt="">
                <p>Transaksi</p>
            </a>

            <a href="/" class="flex flex-col items-center">
                <img src="/icons/Home.png" class="w-8 h-8" alt="">
                <p>Home</p>
            </a>

            <a href="/laporan" class="flex flex-col items-center">
                <img src="/icons/data.png" class="w-8 h-8" alt="">
                <p>Laporan</p>
            </a>

            <a href="/nabung" class="flex flex-col items-center">
                <img src="/icons/babi.png" class="w-8 h-8" alt="">
                <p>Nabung</p>
            </a>

        </div>
    </div>

    <!-- Main -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <div class="h-20 bg-white flex items-center px-6 shadow">
            <h1 class="text-2xl font-semibold">Nama User</h1>
        </div>

        <!-- Content -->
        <div class="flex-1 flex items-start justify-center py-10 relative">

            <!-- Card besar -->
            <div class="bg-[#D9D9D9] rounded-2xl shadow-lg p-6 w-[750px]">

                <!-- Tabs -->
                <div class="flex w-full bg-white rounded-lg overflow-hidden shadow-md">
                    <button class="flex-1 py-3 bg-gray-400 text-black font-semibold">Pemasukan</button>
                    <button class="flex-1 py-3 border-x">Pengeluaran</button>
                    <button class="flex-1 py-3">Tabungan</button>
                </div>

                <!-- Card Form Putih -->
                <div class="mt-6 bg-white p-8 rounded-2xl shadow">

                    <form action="/tambah/store" method="POST">
                        @csrf

                        <!-- Tanggal -->
                        <div class="mb-5">
                            <label class="block mb-1 font-medium">Tanggal</label>
                            <input type="date" name="tanggal"
                                   class="w-full border bg-gray-300 border-gray-400 rounded px-3 py-2">
                        </div>

                        <!-- Kategori -->
                        <div class="mb-5">
                            <label class="block mb-1 font-medium">Kategori</label>
                            <input type="text" name="kategori"
                                   class="w-full border bg-gray-300 border-gray-400 rounded px-3 py-2">
                        </div>

                        <!-- Nominal -->
                        <div class="mb-5">
                            <label class="block mb-1 font-medium">Nominal</label>
                            <input type="number" name="nominal"
                                   class="w-full border bg-gray-300 border-gray-400 rounded px-3 py-2">
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-5">
                            <label class="block mb-1 font-medium">Keterangan</label>
                            <input type="text" name="keterangan"
                                   class="w-full border bg-gray-300 border-gray-400 rounded px-3 py-2">
                        </div>

                        <!-- Button -->
                        <div class="flex justify-center mt-8">
                            <button class="bg-gray-400 px-8 py-2 rounded font-semibold hover:bg-gray-500">
                                Button
                            </button>
                        </div>

                    </form>

                </div>
            </div>



        </div>
    </div>

</body>
</html>
