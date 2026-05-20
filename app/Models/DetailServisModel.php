<?php namespace App\Models;
use CodeIgniter\Model;
class DetailServisModel extends Model {
    protected $table = 'detail_servis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ID_Transaksi', 'ID_Jasa', 'Harga_Satuan'];
}
