<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJasa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'ID_Jasa' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'Nama_Jasa' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'Harga_Satuan' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'Deskripsi' => ['type' => 'TEXT'],
            'Estimasi_Waktu' => ['type' => 'INT', 'constraint' => 11, 'comment' => 'Dalam menit'],
        ]);
        $this->forge->addKey('ID_Jasa', true);
        $this->forge->createTable('jasa');
    }

    public function down()
    {
        $this->forge->dropTable('jasa');
    }
}