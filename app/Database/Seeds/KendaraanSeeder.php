<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        // ID_Pelanggan diasumsikan 1 (Budi) dan 2 (Siti) berdasarkan PelangganSeeder
        $data = [
            [
                'ID_Pelanggan' => 1,
                'No_Polisi'    => 'B 1234 ABC',
                'Merk'         => 'Toyota',
                'Tipe'         => 'Avanza',
            ],
            [
                'ID_Pelanggan' => 2,
                'No_Polisi'    => 'D 5678 XYZ',
                'Merk'         => 'Honda',
                'Tipe'         => 'Vario 150',
            ],
        ];

        $this->db->table('kendaraan')->insertBatch($data);
    }
}