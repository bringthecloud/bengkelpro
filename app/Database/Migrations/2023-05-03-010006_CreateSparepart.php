<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSparepart extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_Sparepart' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'Nama_Barang' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'Harga_Jual' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Harga_Beli' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Stok_Barang' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'Satuan' => ['type' => 'VARCHAR', 'constraint' => '20', 'default' => 'Pcs'],
        ]);
        $this->forge->addKey('ID_Sparepart', true);
        $this->forge->createTable('sparepart');
    }

    public function down()
    {
        $this->forge->dropTable('sparepart');
    }
}