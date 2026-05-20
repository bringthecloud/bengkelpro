<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DetailTransaksiSeeder extends Seeder
{
    public function run()
    {
        // ID_Transaksi diasumsikan 1 (dari TransaksiSeeder)
        // ID_Jasa diasumsikan 1 (Ganti Oli)
        $data = [
            [
                'ID_Transaksi' => 1,
                'ID_Jasa'      => 1,
                'ID_Sparepart' => null,
                'Jumlah'       => 1,
                'Subtotal'     => 50000,
            ],
            [
                'ID_Transaksi' => 1,
                'ID_Jasa'      => null,
                'ID_Sparepart' => 1, // Oli Shell
                'Jumlah'       => 2,
                'Subtotal'     => 130000, // 65000 x 2
            ],
        ];

        $this->db->table('detail_transaksi')->insertBatch($data);
        
        // Update Total Harga di Transaksi agar sesuai detail
        $total = 50000 + 130000;
        $this->db->table('transaksi')->where('ID_Transaksi', 1)->update(['Total_Harga' => $total]);
    }
}