<?php namespace App\Controllers;

use App\Models\TransaksiModel;

class Laporan extends BaseController {
    public function index() {
        $db = \Config\Database::connect();
        $data['title'] = 'Laporan Transaksi';
        $data['laporan'] = $db->query("
            SELECT t.*, k.No_Polisi, k.Merk, k.Tipe, p.Nama_Lengkap
            FROM transaksi t
            LEFT JOIN kendaraan k ON t.ID_Kendaraan = k.ID_Kendaraan
            LEFT JOIN pelanggan p ON k.ID_Pelanggan = p.ID_Pelanggan
            ORDER BY t.ID_Transaksi DESC
        ")->getResultArray();
        return view('laporan/index', $data);
    }
}