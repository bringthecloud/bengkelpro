<?php 

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        // 1. Paksa matikan foreign key check agar tabel pelanggan bisa dibersihkan
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0;');
        
        // 2. Kosongkan tabel anak (kendaraan & transaksi) terlebih dahulu, baru tabel pelanggan
        $this->db->table('transaksi')->truncate();
        $this->db->table('kendaraan')->truncate();
        $this->db->table('pelanggan')->truncate();
        
        // 3. Hidupkan kembali foreign key check
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1;');

        // 4. Data 5 Pelanggan agar pas dengan data KendaraanSeeder
        $data = [
            [
                'Nama_Lengkap' => 'Budi Santoso',
                'No_Telepon'   => '08123456789',
                'Alamat'       => 'Jl. Merdeka No. 45, Jakarta',
            ],
            [
                'Nama_Lengkap' => 'Siti Aminah',
                'No_Telepon'   => '08987654321',
                'Alamat'       => 'Jl. Kebahagiaan No. 10, Bandung',
            ],
            [
                'Nama_Lengkap' => 'Ahmad Fauzi',
                'No_Telepon'   => '08345678901',
                'Alamat'       => 'Jl. Margonda Raya No. 12, Depok',
            ],
            [
                'Nama_Lengkap' => 'Hendra Wijaya',
                'No_Telepon'   => '08456789012',
                'Alamat'       => 'Jl. Raya Pajajaran No. 88, Bogor',
            ],
            [
                'Nama_Lengkap' => 'Rizky Pratama',
                'No_Telepon'   => '08567890123',
                'Alamat'       => 'Jl. KH Noer Ali No. 5, Bekasi',
            ],
        ];

        // 5. Eksekusi masukkin data secara massal
        $this->db->table('pelanggan')->insertBatch($data);
    }
}