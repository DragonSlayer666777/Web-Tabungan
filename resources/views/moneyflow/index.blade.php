<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-blue-500 to-cyan-600 pt-20 pb-32 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Tabs -->
        <div class="bg-white/20 backdrop-blur-lg rounded-2xl p-1 mb-8 shadow-xl">
            <div class="flex">
                @foreach(['income' => 'Pemasukan', 'expense' => 'Pengeluaran', 'saving' => 'Tabungan'] as $key => $label)
                    <a href="{{ route('moneyflow') }}?type={{ $key }}"
                       class="flex-1 text-center py-4 rounded-xl font-semibold transition {{ $type === $key ? 'bg-white text-blue-600 shadow-lg' : 'text-white/80 hover:text-white' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8">
            <form action="{{ route('moneyflow.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ $type === 'saving' ? 'income' : $type }}">

                <div class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Nominal</label>
                        <input type="number" name="amount" required placeholder="0" 
                               class="w-full px-6 py-4 text-2xl font-bold rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Tanggal</label>
                        <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" required
                               class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <select name="category_id" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none">
                            <option value="">Pilih kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Keterangan (opsional)</label>
                        <input type="text" name="description" placeholder="Contoh: Gaji bulan Desember"
                               class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none">
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('dashboard') }}" 
                           class="flex-1 py-4 bg-gray-200 text-gray-700 font-bold rounded-xl text-center hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit"
                                class="flex-1 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>

 
    </div>


</div>
</x-app-layout>