<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 sm:px-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $saving->name }}</h1>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $saving->description }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('savings.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Daftar Tabungan
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Informasi Tabungan -->
                    <div class="lg:col-span-1">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="flex justify-between items-start mb-6">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Progres Tabungan</h2>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $saving->progress >= 100 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' }}">
                                    {{ $saving->progress }}%
                                </span>
                            </div>
                            
                            <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
                                <div class="bg-blue-600 h-3 rounded-full" style="width: {{ $saving->progress }}%"></div>
                            </div>
                            
                            <div class="mt-6 space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Terkumpul</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($saving->current_amount, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Sisa yang dibutuhkan</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($saving->remaining, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Target</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($saving->target_amount, 0, ',', '.') }}</span>
                                </div>
                                @if($saving->deadline)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Deadline</span>
                                        <span class="text-sm {{ $saving->deadline->isPast() ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">{{ $saving->deadline->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Form Tambah Setoran -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Tambah Setoran</h2>
                            
                            <form method="POST" action="{{ route('savings.addTransaction', $saving) }}" class="space-y-6">
                                @csrf
                                
                                <div>
                                    <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nominal Setoran</label>
                                    <input type="number" id="amount" name="amount" step="0.01" min="0.01" required
                                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                           placeholder="Masukkan nominal setoran">
                                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Setoran</label>
                                        <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required
                                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                    </div>
                                    <div>
                                        <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
                                        <textarea id="note" name="note" rows="3" 
                                                  class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                  placeholder="Catatan setoran (opsional)">{{ old('note') }}</textarea>
                                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Tambah Setoran
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Riwayat Setoran -->
                        @if($saving->transactions->isNotEmpty())
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Riwayat Setoran</h3>
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nominal</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                                @foreach($saving->transactions as $transaction)
                                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                                            {{  \Carbon\Carbon::parse($transaction->date)->translatedFormat('l, d F Y') }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">
                                                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $transaction->note ?? '-' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>