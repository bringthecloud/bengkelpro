<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDetailTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_Detail' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ID_Transaksi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            // ID Jasa boleh kosong (NULL) jika yang diambil adalah sparepart
            'ID_Jasa' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            // ID Sparepart boleh kosong (NULL) jika yang diambil adalah jasa
            'ID_Sparepart' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'Jumlah' => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'Subtotal' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
        ]);
        $this->forge->addKey('ID_Detail', true);
        
        // Hubungkan ke tabel Transaksi
        $this->forge->addForeignKey('ID_Transaksi', 'transaksi', 'ID_Transaksi', 'CASCADE', 'CASCADE');
        
        // Hubungkan ke tabel Jasa (Set null jika Jasa dihapus, atau Cascade? Kita pakai Set Null biar riwayat tetap ada)
        $this->forge->addForeignKey('ID_Jasa', 'jasa', 'ID_Jasa', 'SET_NULL', 'CASCADE');
        
        // Hubungkan ke tabel Sparepart
        $this->forge->addForeignKey('ID_Sparepart', 'sparepart', 'ID_Sparepart', 'SET_NULL', 'CASCADE');
        
        $this->forge->createTable('detail_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('detail_transaksi');
    }
}