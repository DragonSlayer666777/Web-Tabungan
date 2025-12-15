<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $defaultCategories = [
            // Pemasukan
            ['name' => 'Gaji', 'type' => 'income'],
            ['name' => 'Bonus', 'type' => 'income'],
            ['name' => 'Freelance', 'type' => 'income'],
            ['name' => 'Hadiah', 'type' => 'income'],
            ['name' => 'Lain-lain', 'type' => 'income'],

            // Pengeluaran
            ['name' => 'Makan & Minum', 'type' => 'expense'],
            ['name' => 'Transportasi', 'type' => 'expense'],
            ['name' => 'Belanja', 'type' => 'expense'],
            ['name' => 'Hiburan', 'type' => 'expense'],
            ['name' => 'Tagihan', 'type' => 'expense'],
            ['name' => 'Kesehatan', 'type' => 'expense'],
            ['name' => 'Lain-lain', 'type' => 'expense'],
        ];

        // Isi untuk user pertama (biasanya id=1 setelah register)
        foreach ($defaultCategories as $cat) {
            Category::create([
                'user_id' => auth()->id(), // ganti jadi auth()->id() kalau mau dinamis nanti
                'name'    => $cat['name'],
                'type'    => $cat['type'],
            ]);
        }
    }
}