<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_Transaksi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ID_User' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // WAJIB SAMA KAYAK DI TABEL USERS
            ],
            'ID_Kendaraan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // WAJIB SAMA KAYAK DI TABEL KENDARAAN
            ],
            'Tanggal_Masuk' => ['type' => 'DATETIME'],
            'Keluhan' => ['type' => 'TEXT'],
            'Total_Harga' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'Status_Bayar' => ['type' => 'ENUM', 'constraint' => ['Pending', 'Lunas'], 'default' => 'Pending'],
        ]);
        $this->forge->addKey('ID_Transaksi', true);
        
        // Hubungkan ke tabel users
        $this->forge->addForeignKey('ID_User', 'users', 'ID_User', 'CASCADE', 'CASCADE');
        
        // Hubungkan ke tabel kendaraan
        $this->forge->addForeignKey('ID_Kendaraan', 'kendaraan', 'ID_Kendaraan', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}