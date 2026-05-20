<?php namespace App\Models;
use CodeIgniter\Model;
class PelangganModel extends Model {
    protected $table = 'pelanggan';
    protected $primaryKey = 'ID_Pelanggan';
    protected $allowedFields = ['Nama_Lengkap', 'No_Telepon', 'Alamat'];
}