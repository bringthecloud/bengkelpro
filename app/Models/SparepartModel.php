<?php namespace App\Models;
use CodeIgniter\Model;
class SparepartModel extends Model {
    protected $table = 'sparepart';
    protected $primaryKey = 'ID_Sparepart';
    protected $allowedFields = ['Nama_Barang', 'Harga_Jual', 'Harga_Beli', 'Stok_Barang', 'Satuan'];
}
