<?php namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\KendaraanModel;

class Dashboard extends BaseController {
    public function index() {
        $transModel = new TransaksiModel();
        $kendModel  = new KendaraanModel();

        $pelangganModel = new \App\Models\PelangganModel();
        $jasaModel      = new \App\Models\JasaModel();
        $sparepartModel = new \App\Models\SparepartModel();

        $data['title'] = 'Dashboard';
        $data['totalPelanggan']  = $pelangganModel->countAll();
        $data['totalKendaraan']  = $kendModel->countAll();
        $data['totalTransaksi']  = $transModel->countAll();
        $data['totalJasa']       = $jasaModel->countAll();
        $data['totalSparepart']  = $sparepartModel->countAll();

        // Pendapatan
        $allTrans = $transModel->findAll();
        $totalPendapatan = 0;
        foreach ($allTrans as $t) {
            $totalPendapatan += $t['Total_Harga'] ?? 0;
        }
        $data['totalPendapatan'] = $totalPendapatan;

        // Recent transactions
        $data['recentTrans'] = $transModel->orderBy('Tanggal_Masuk', 'DESC')->findAll(5);

        return view('dashboard/index', $data);
    }
}