<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 sm:px-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Hutang & Piutang</h1>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('debts.create') }}" 
                           class="inline-flex items-center px-6 py-2 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Catat Hutang/Piutang
                        </a>
                    </div>
                </div>

                @if($debts->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada data hutang atau piutang</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai catat hutang atau piutang untuk mengelola keuangan Anda.</p>
                        <div class="mt-6">
                            <a href="{{ route('debts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                Catat Hutang/Piutang
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($debts as $debt)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $debt->person_name }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $debt->type === 'debt' ? 'Hutang' : 'Piutang' }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $debt->is_paid ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                        {{ $debt->is_paid ? 'Lunas' : 'Belum Lunas' }}
                                    </span>
                                </div>
                                
                                <div class="mt-4 space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Total</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($debt->amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Sudah Dibayar</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">Rp {{ number_format($debt->paid_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Sisa</span>
                                        <span class="font-semibold {{ $debt->remaining > 0 ? 'text-red-600' : 'text-green-600' }}">Rp {{ number_format($debt->remaining, 0, ',', '.') }}</span>
                                    </div>
                                    @if($debt->due_date)
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Jatuh Tempo</span>
                                            <span class="text-sm {{ $debt->due_date->isPast() ? 'text-red-600' : 'text-gray-900 dark:text-white' }}">{{ $debt->due_date->format('d M Y') }}</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mt-6">
                                    <a href="{{ route('debts.show', $debt) }}" 
                                       class="block w-full text-center px-4 py-2 border border-orange-300 dark:border-orange-600 text-sm font-medium rounded-lg text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/30 hover:bg-orange-100 dark:hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                        Lihat Detail & Tambah Pembayaran
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>