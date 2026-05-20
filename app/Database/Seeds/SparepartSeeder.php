<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SparepartSeeder extends Seeder
{
    public function run()
    {
        $data = [
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
        ];

        $this->db->table('sparepart')->insertBatch($data);
    }
}