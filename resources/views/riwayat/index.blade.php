<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - MoneyTrack</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-blue-500 to-cyan-600">

    
    <x-sidebar />

    <!-- Main Content -->
    <main class="pl-64 min-h-screen flex flex-col">
        <div class="flex-1 px-6 py-12 max-w-5xl mx-auto w-full">

            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-white drop-shadow-lg">
                    Riwayat Transaksi
                </h1>
            </div>

            <!-- Card Riwayat -->
            <div class="bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl p-8 border border-white/20">


                <!-- Daftar Transaksi -->
                <div class="space-y-6">
                    @forelse($transactions as $t)
                        <div class="bg-white rounded-3xl p-8 shadow-xl hover:scale-[1.02] transition-all duration-300 flex justify-between items-center">
                            <div>
                                <div class="text-2xl font-bold text-gray-800">
                                    {{ $t->category->name }}
                                </div>
                                <div class="text-gray-600 mt-1">
                                    {{ \Carbon\Carbon::parse($t->date)->translatedFormat('l, d F Y') }}
                                </div>
                                @if($t->description)
                                    <div class="text-gray-500 text-sm mt-2 italic">
                                        "{{ $t->description }}"
                                    </div>
                                @endif
                            </div>

                            <div class="text-right">
                                <div class="text-4xl font-bold {{ $t->category->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $t->category->type === 'income' ? '+' : '-' }}
                                    Rp {{ number_format($t->amount, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <svg class="mx-auto w-24 h-24 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-3xl text-white mt-6 font-medium">Belum ada transaksi</p>
                            <a href="{{ route('moneyflow') }}" 
                               class="mt-8 inline-block bg-white text-blue-600 px-10 py-5 rounded-2xl text-xl font-bold shadow-2xl hover:scale-105 transition">
                                Mulai Catat Transaksi
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $transactions->withQueryString()->links() }}
                </div>
            </div>


        </div>
    </main>
</body>
</html>