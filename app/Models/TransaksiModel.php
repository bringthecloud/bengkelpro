<?php namespace App\Models;
use CodeIgniter\Model;
class TransaksiModel extends Model {
    protected $table = 'transaksi';
    protected $primaryKey = 'ID_Transaksi';
    protected $allowedFields = ['ID_User', 'ID_Kendaraan', 'Tanggal_Masuk', 'Keluhan', 'Total_Harga', 'Status_Bayar'];
}