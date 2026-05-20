<?php namespace App\Models;
use CodeIgniter\Model;
class DetailSparepartModel extends Model {
    protected $table = 'detail_sparepart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ID_Transaksi', 'ID_Sparepart', 'Jumlah', 'Harga_Satuan'];
}
