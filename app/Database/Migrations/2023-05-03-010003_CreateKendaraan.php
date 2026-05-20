<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKendaraan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_Kendaraan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ID_Pelanggan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true, // WAJIB SAMA KAYAK DI TABEL PELANGGAN
            ],
            'No_Polisi' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'Merk' => ['type' => 'VARCHAR', 'constraint' => '50'],
            'Tipe' => ['type' => 'VARCHAR', 'constraint' => '50'],
        ]);
        $this->forge->addKey('ID_Kendaraan', true);
        
        // Hubungkan ke tabel pelanggan
        $this->forge->addForeignKey('ID_Pelanggan', 'pelanggan', 'ID_Pelanggan', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('kendaraan');
    }

    public function down()
    {
        $this->forge->dropTable('kendaraan');
    }
}