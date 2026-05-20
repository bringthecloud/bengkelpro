<?php 

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        // 1. Paksa matikan foreign key check biar bisa dikosongkan tanpa eror constraint
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0;');
        
        // 2. Kosongkan tabel transaksi terlebih dahulu (jika ada) karena dia mengikat ID_Kendaraan
        $this->db->table('transaksi')->truncate();
        $this->db->table('kendaraan')->truncate();
        
        // 3. Hidupkan kembali foreign key check
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1;');

        // 4. Data Variasi Kendaraan Pelanggan (Motor & Mobil Populer)
        $data = [
            [
                'ID_Pelanggan' => 1,
                'No_Polisi'    => 'B 1234 ABC',
                'Merk'         => 'Toyota',
                'Tipe'         => 'Avanza 1.3 G',
            ],
            [
                'ID_Pelanggan' => 2,
                'No_Polisi'    => 'D 5678 XYZ',
                'Merk'         => 'Honda',
                'Tipe'         => 'Vario 150 Esp',
            ],
            [
                'ID_Pelanggan' => 1,
                'No_Polisi'    => 'B 3941 KJL',
                'Merk'         => 'Honda',
                'Tipe'         => 'Beat Street',
            ],
            [
                'ID_Pelanggan' => 3,
                'No_Polisi'    => 'F 2026 TGD',
                'Merk'         => 'Yamaha',
                'Tipe'         => 'NMAX 155 Connected',
            ],
            [
                'ID_Pelanggan' => 4,
                'No_Polisi'    => 'B 4412 SAA',
                'Merk'         => 'Toyota',
                'Tipe'         => 'Kijang Innova Reborn',
            ],
            [
                'ID_Pelanggan' => 2,
                'No_Polisi'    => 'D 9012 MNB',
                'Merk'         => 'Honda',
                'Tipe'         => 'PCX 160',
            ],
            [
                'ID_Pelanggan' => 5,
                'No_Polisi'    => 'B 7788 CXX',
                'Merk'         => 'Suzuki',
                'Tipe'         => 'Ertiga Hybrid',
            ],
            [
                'ID_Pelanggan' => 3,
                'No_Polisi'    => 'F 4510 OP',
                'Merk'         => 'Yamaha',
                'Tipe'         => 'Mio M3',
            ],
        ];

        // 5. Masukkan semua data secara batch
        $this->db->table('kendaraan')->insertBatch($data);
    }
}