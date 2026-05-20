<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        // ID_User diasumsikan 1 (Admin yang login)
        // ID_Kendaraan diasumsikan 1 (Toyota Avanza punya Budi)
        $data = [
            [
                'ID_User'       => 1,
                'ID_Kendaraan'  => 1,
                'Tanggal_Masuk' => date('Y-m-d H:i:s'),
                'Keluhan'       => 'Suara mesin kasar, tarikan berat.',
                'Total_Harga'   => 50000, // Akan diupdate detailnya nanti
                'Status_Bayar'  => 'Lunas',
            ],
        ];

        $this->db->table('transaksi')->insertBatch($data);
    }
}