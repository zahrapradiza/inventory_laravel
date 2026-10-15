<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Akun Pengguna Sesuai P4 Teman
        // Password default: "password123"
        User::firstOrCreate(
            ['username' => 'admin_tes'],
            [
                'password' => Hash::make('password123'),
                'full_name' => 'Admin Tester',
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['username' => 'staff_tes'],
            [
                'password' => Hash::make('password123'),
                'full_name' => 'Staff Tester',
                'role' => 'staff',
            ]
        );

        // Tambahan akun admin standar
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'full_name' => 'Administrator',
                'role' => 'admin',
            ]
        );

        // 2. Kategori Awal Sesuai schema.sql P4 Teman
        $catMakanan = Category::firstOrCreate(['name' => 'Makanan'], ['description' => 'Produk makanan']);
        $catMinuman = Category::firstOrCreate(['name' => 'Minuman'], ['description' => 'Produk minuman']);
        $catAtk     = Category::firstOrCreate(['name' => 'Alat Tulis'], ['description' => 'Perlengkapan alat tulis']);

        // 3. Supplier Awal
        $supplier1 = Supplier::firstOrCreate(
            ['name' => 'PT Sumber Pangan Utama'],
            ['contact_info' => '08123456789 (Bpk. Joko) - Jakarta']
        );

        // 4. Produk Awal
        $prod1 = Product::firstOrCreate(
            ['sku' => 'MKN-001'],
            [
                'name' => 'Biskuit Roma Kelapa 300g',
                'category_id' => $catMakanan->id,
                'price' => 12500,
                'stock' => 25,
                'minimum_stock' => 5,
            ]
        );

        $prod2 = Product::firstOrCreate(
            ['sku' => 'MNM-001'],
            [
                'name' => 'Teh Botol Sosro 450ml',
                'category_id' => $catMinuman->id,
                'price' => 6000,
                'stock' => 3, // Di bawah minimum_stock agar muncul tanda stok menipis
                'minimum_stock' => 10,
            ]
        );

        $prod3 = Product::firstOrCreate(
            ['sku' => 'ATK-001'],
            [
                'name' => 'Buku Tulis Sinar Dunia 38 Lembar',
                'category_id' => $catAtk->id,
                'price' => 4500,
                'stock' => 50,
                'minimum_stock' => 10,
            ]
        );
    }
}
