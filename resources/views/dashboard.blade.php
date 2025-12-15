<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MoneyTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-blue-300">

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="ml-0 lg:ml-64 min-h-screen">
        <div class="px-6 py-8">

            <!-- Header -->
            <div class="max-w-7xl mx-auto mb-10">
                <h1 class="text-4xl font-extrabold text-gray-800">
                    Halo, {{ auth()->user()->name }}!
                </h1>
                <p class="text-xl text-gray-600 mt-2">Berinvestasi dalam diri Anda</p>
            </div>

            <!-- Total Tabungan (Hero Card) -->
            <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 p-1 
                          transform transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl max-w-4xl mx-auto">
                <div class="bg-white/95 backdrop-blur-xl rounded-3xl p-12 text-center relative z-10">
                    <div class="absolute top-6 right-8 opacity-20">
                        <svg class="w-32 h-32 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            
                        </svg>
                    </div>

                    <p class="text-gray-600 text-xl font-medium mb-4">Total Tabungan Kamu</p>
                    <p class="text-6xl font-mono font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 drop-shadow-lg">
                        Rp {{ number_format(auth()->user()->balance, 0, ',', '.') }}
                    </p>
                    <p class="text-lg text-gray-500 mt-6">Terus semangat menabung!</p>
                </div>
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-blue-600/20 to-purple-600/20 blur-xl 
                            transform scale-105 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            </div>
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Target Nabung Kamu</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($targetNabung as $target)
                            <div class="block relative overflow-hidden rounded-3xl bg-white shadow-xl transition-all duration-300">

                                {{-- Gambar Target --}}
                                
                                @if($target->image)
                                    <img src="{{asset('storage/' . $target->image)}}" 
                                        alt="{{ $target->name }}"
                                        class="w-full h-48 object-cover rounded-t-3xl group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 rounded-t-3xl flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                    {{-- Isi Card --}}
                                    <div class="p-6">
                                        <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                            {{ $target->name }}
                                        </h3>
                                        
                                        

                                        <div class="flex justify-between items-center mt-2">
                                            <span class="text-gray-600 font-medium">Total Target</span>
                                            <span class="text-blue-600 font-bold text-lg">
                                                Rp {{ number_format($target->target_amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if($targetNabung->isEmpty())
                        <div class="col-span-3 text-center py-16 bg-white rounded-3xl shadow-lg">
                            <svg class="mx-auto w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2m2-2h10m0 0v2m0-2V9m-1 0a1 1 0 011 1v3M5 13V10a1 1 0 011-1H4m12 4v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5"/>
                            </svg>
                            <p class="text-2xl text-gray-800 mt-4">Belum ada target nabung</p>
                            <a href="{{ route('savings.create') }}" class="mt-6 inline-block bg-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg">
                                Buat Target Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto mt-12">
                <!-- Pemasukan Bulan Ini -->
                <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 border border-gray-200/50 shadow-xl hover:shadow-2xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-lg">Pemasukan Bulan Ini</p>
                            <p class="text-4xl  font-mono font-extrabold text-green-600 mt-3">
                                Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-4 bg-green-100 rounded-full">
                            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pengeluaran Bulan Ini -->
                <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 border border-gray-200/50 shadow-xl hover:shadow-2xl transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-lg">Pengeluaran Bulan Ini</p>
                            <p class="text-4xl  font-mono font-extrabold text-red-600 mt-3">
                                Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-4 bg-red-100 rounded-full">
                            <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Transaksi Terakhir -->
                <div class="bg-white/80 backdrop-blur-lg rounded-3xl p-8 border border-gray-200/50 shadow-xl hover:shadow-2xl transition-all">
                    <p class="text-gray-600 text-lg mb-4">Transaksi Terakhir</p>
                    @if($transaksiTerakhir->count())
                        <div class="space-y-3 max-h-48 overflow-y-auto">
                            @foreach($transaksiTerakhir as $t)
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 last:border-0">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $t->category->name }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($t->date)->translatedFormat('l, d F Y') }}</p>
                                    </div>
                                    <p class="font-bold {{ $t->category->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $t->category->type === 'income' ? '+' : '-' }}Rp {{ number_format($t->amount, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">-</p>
                    @endif
                </div>
            </div>

            <!-- Floating Button -->
            <a href="{{ route('moneyflow') }}"
               class="fixed bottom-8 right-8 w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full 
                      flex items-center justify-center shadow-2xl hover:shadow-purple-500/50 transform hover:scale-110 
                      transition-all duration-300 z-50 group">
                <span class="text-5xl font-bold drop-shadow-lg">+</span>
                <span class="absolute -top-14 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-sm px-4 py-2 rounded-lg opacity-0 
                             group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                    Tambah Transaksi
                </span>
            </a>
        </div>
    </main>
</body>
</html>