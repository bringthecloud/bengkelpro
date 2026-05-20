<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_Pelanggan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'Nama_Lengkap' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'No_Telepon' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'Alamat' => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('ID_Pelanggan', true);
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}