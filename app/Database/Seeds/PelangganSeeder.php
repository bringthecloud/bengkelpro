<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'Nama_Lengkap' => 'Budi Santoso',
                'No_Telepon'  => '08123456789',
                'Alamat'       => 'Jl. Merdeka No. 45, Jakarta',
            ],
            [
                'Nama_Lengkap' => 'Siti Aminah',
                'No_Telepon'  => '08987654321',
                'Alamat'       => 'Jl. Kebahagiaan No. 10, Bandung',
            ],
        ];

        $this->db->table('pelanggan')->insertBatch($data);
    }
}