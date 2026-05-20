<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JasaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'Nama_Jasa'     => 'Ganti Oli Mesin',
                'Harga_Satuan' => 50000,
                'Deskripsi'     => 'Ganti oli mesin 4 tak (Oli Shell)',
                'Estimasi_Waktu'=> 30,
            ],
            [
                'Nama_Jasa'     => 'Spooring & Balancing',
                'Harga_Satuan' => 150000,
                'Deskripsi'     => 'Kesesuaikan roda agar lurus',
                'Estimasi_Waktu'=> 60,
            ],
            [
                'Nama_Jasa'     => 'Service Ringan (Tune Up)',
                'Harga_Satuan' => 100000,
                'Deskripsi'     => 'Cek busi, karbu/injeksi, filter udara',
                'Estimasi_Waktu'=> 45,
            ],
        ];

        $this->db->table('jasa')->insertBatch($data);
    }
}