<?php namespace App\Models;
use CodeIgniter\Model;
class JasaModel extends Model {
    protected $table = 'jasa';
    protected $primaryKey = 'ID_Jasa';
    protected $allowedFields = ['Nama_Jasa', 'Harga_Satuan', 'Deskripsi', 'Estimasi_Waktu'];
}
