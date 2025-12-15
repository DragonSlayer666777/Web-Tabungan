<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - {{ $startDate->translatedFormat('F Y') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-blue-500 to-cyan-600">

    
    <x-sidebar />

    <!-- Main Content (mulai dari kanan sidebar) -->
    <main class="pl-64 min-h-screen flex flex-col">
        <div class="flex-1 px-6 py-12 max-w-6xl mx-auto w-full">
            
            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-5xl font-bold text-white mb-3 drop-shadow-lg">
                    Laporan Keuangan
                </h1>
                <p class="text-2xl text-blue-100 font-medium">
                    {{ $startDate->translatedFormat('F Y') }}
                </p>
            </div>

            <!-- Card Grafik -->
            <div class="bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="bg-gray-50/80 rounded-2xl p-10 shadow-inner">
                    <canvas id="reportChart" height="320"></canvas>
                </div>

                <!-- Navigasi Bulan -->
                <div class="flex justify-center items-center mt-10 gap-8">
                    <a href="{{ route('laporan', ['month' => $startDate->copy()->subMonth()->month, 'year' => $startDate->copy()->subMonth()->year]) }}"
                       class="text-white text-5xl hover:scale-125 transition duration-200">
                        ←
                    </a>

                    <div class="bg-white/30 backdrop-blur-xl px-12 py-5 rounded-3xl text-white font-bold text-2xl shadow-lg">
                        {{ $startDate->translatedFormat('F Y') }}
                    </div>

                    <a href="{{ route('laporan', ['month' => $startDate->copy()->addMonth()->month, 'year' => $startDate->copy()->addMonth()->year]) }}"
                       class="text-white text-5xl hover:scale-125 transition duration-200">
                        →
                    </a>
                </div>
            </div>


        </div>
    </main>

    <!-- Chart.js dari CDN (nggak perlu npm run dev) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('reportChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [
                    {
                        label: 'Pengeluaran',
                        data: @json($expenseData),
                        borderColor: '#FF6B35',
                        backgroundColor: 'rgba(255, 107, 53, 0.15)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 6,
                        pointHoverRadius: 10,
                    },
                    {
                        label: 'Pemasukan',
                        data: @json($incomeData),
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.15)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 6,
                        pointHoverRadius: 10,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ctx.dataset.label + ': Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>