<?php namespace App\Models;
use CodeIgniter\Model;
class KendaraanModel extends Model {
    protected $table = 'kendaraan';
    protected $primaryKey = 'ID_Kendaraan';
    protected $allowedFields = ['ID_Pelanggan', 'No_Polisi', 'Merk', 'Tipe'];
}