<x-app-layout>
<x-sidebar />
<div class="min-h-screen bg-gradient-to-br from-blue-500 to-cyan-600 py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white/20 backdrop-blur-lg rounded-3xl shadow-2xl p-10">
        <h1 class="text-4xl font-bold text-white mb-8 text-center">Buat Target Nabung Baru</h1>

        <form method="POST" action="{{ route('savings.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Nama Tabungan -->
                <div>
                    <label class="block text-white font-medium mb-2">Nama Tabungan</label>
                    <input type="text" name="name" required placeholder="Contoh: Beli HP Baru"
                           class="w-full px-6 py-4 rounded-xl bg-white/50 text-white placeholder-gray-300 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                </div>

                <!-- Gambar Barang -->
                <div>
                    <label class="block text-white font-medium mb-2">Gambar Barang</label>
                    <input type="file" name="image" accept="image/*" 
                           class="w-full px-6 py-4 rounded-xl bg-white/50 text-white file:bg-blue-600 file:text-white file:px-4 file:py-2 file:rounded-xl file:border-0 file:mr-4 focus:ring-2 focus:ring-blue-300">
                </div>

                <!-- Target Nominal -->
                <div>
                    <label class="block text-white font-medium mb-2">Target Nominal</label>
                    <input type="number" name="target_amount" required min="1" placeholder="1000000"
                           class="w-full px-6 py-4 rounded-xl bg-white/50 text-white placeholder-gray-300 focus:ring-2 focus:ring-blue-300">
                </div>

                <!-- Frekuensi -->
                <div>
                    <label class="block text-white font-medium mb-2">Rencana Pengisian</label>
                    <select name="frequency" required class="w-full px-6 py-4 rounded-xl bg-white/50 text-white focus:ring-2 focus:ring-blue-300">
                        <option value="">Pilih Frekuensi</option>
                        <option value="daily">Harian</option>
                        <option value="weekly">Mingguan</option>
                        <option value="monthly">Bulanan</option>
                    </select>
                </div>

                <!-- Nominal Min per Pengisian -->
                <div>
                    <label class="block text-white font-medium mb-2">Nominal Minimum per Pengisian</label>
                    <input type="number" name="min_amount" required min="1" placeholder="10000"
                           class="w-full px-6 py-4 rounded-xl bg-white/50 text-white placeholder-gray-300 focus:ring-2 focus:ring-blue-300">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-white font-medium mb-2">Deskripsi</label>
                    <textarea name="description" placeholder="Catatan tambahan"
                              class="w-full px-6 py-4 rounded-xl bg-white/50 text-white placeholder-gray-300 focus:ring-2 focus:ring-blue-300"></textarea>
                </div>

                <!-- Tombol -->
                <div class="flex gap-4 justify-end">
                    <a href="{{ route('savings.index') }}" class="px-8 py-4 bg-gray-300 text-gray-800 font-bold rounded-xl hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                        Buat Target
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</x-app-layout>