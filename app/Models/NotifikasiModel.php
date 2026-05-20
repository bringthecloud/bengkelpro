<?php namespace App\Models;
use CodeIgniter\Model;
class NotifikasiModel extends Model {
    protected $table = 'notifikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pesan', 'tipe', 'icon', 'is_read', 'created_at'];
    protected $useTimestamps = false;
}
