<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $daftar = ['Minuman', 'Makanan', 'Snack', 'Bumbu Dapur', 'Frozen Food'];

        // firstOrCreate: buat jika belum ada, jadi data lama tidak dobel
        foreach ($daftar as $nama) {
            Category::firstOrCreate(['nama' => $nama]);
        }
    }
}
