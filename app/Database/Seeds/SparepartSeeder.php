<?php 

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SparepartSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // --- Data Lama Bawaan Kamu ---
            [
                'Nama_Barang'  => 'Oli Shell Helix 10W-40',
                'Harga_Jual'   => 65000,
                'Harga_Beli'   => 50000,
                'Stok_Barang'  => 10,
                'Satuan'       => 'Botol',
            ],
            [
                'Nama_Barang'  => 'Kampas Rem Depan Avanza',
                'Harga_Jual'   => 250000,
                'Harga_Beli'   => 200000,
                'Stok_Barang'  => 5,
                'Satuan'       => 'Set',
            ],
            [
                'Nama_Barang'  => 'Busi Iridium',
                'Harga_Jual'   => 35000,
                'Harga_Beli'   => 25000,
                'Stok_Barang'  => 20,
                'Satuan'       => 'Pcs',
            ],

            // --- Tambahan Data Baru Sesuai Gambar (Harga Marketplace) ---
            [
                'Nama_Barang'  => 'Ban Motor Tubeless (Standard)',
                'Harga_Jual'   => 185000,
                'Harga_Beli'   => 150000,
                'Stok_Barang'  => 15,
                'Satuan'       => 'Pcs',
            ],
            [
                'Nama_Barang'  => 'Kampas Rem Depan Motor',
                'Harga_Jual'   => 45000,
                'Harga_Beli'   => 30000,
                'Stok_Barang'  => 30,
                'Satuan'       => 'Set',
            ],
            [
                'Nama_Barang'  => 'Rantai & Gear Set (Drive Chain Kit)',
                'Harga_Jual'   => 195000,
                'Harga_Beli'   => 160000,
                'Stok_Barang'  => 12,
                'Satuan'       => 'Set',
            ],
            [
                'Nama_Barang'  => 'Shock Breaker Belakang',
                'Harga_Jual'   => 250000,
                'Harga_Beli'   => 210000,
                'Stok_Barang'  => 8,
                'Satuan'       => 'Pcs',
            ],
            [
                'Nama_Barang'  => 'Lampu & Bohlam Depan LED',
                'Harga_Jual'   => 35000,
                'Harga_Beli'   => 22000,
                'Stok_Barang'  => 25,
                'Satuan'       => 'Pcs',
            ],
            [
                'Nama_Barang'  => 'Aki / Baterai Motor MF (Maintenance Free)',
                'Harga_Jual'   => 210000,
                'Harga_Beli'   => 175000,
                'Stok_Barang'  => 10,
                'Satuan'       => 'Pcs',
            ],
            [
                'Nama_Barang'  => 'Filter Udara (Air Cleaner)',
                'Harga_Jual'   => 40000,
                'Harga_Beli'   => 28000,
                'Stok_Barang'  => 20,
                'Satuan'       => 'Pcs',
            ],
        ];

        $this->db->table('sparepart')->insertBatch($data);
    }
}