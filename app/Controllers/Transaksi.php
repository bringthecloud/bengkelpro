<?php namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\KendaraanModel;
use App\Models\PelangganModel;
use App\Models\JasaModel;
use App\Models\SparepartModel;
use App\Models\DetailServisModel;
use App\Models\DetailSparepartModel;
use App\Models\NotifikasiModel;

class Transaksi extends BaseController {
    protected $transModel, $kendModel;
    
    public function __construct() {
        $this->transModel = new TransaksiModel();
        $this->kendModel = new KendaraanModel();
    }

    public function index() {
        $data['title'] = 'Transaksi';
        // Join kendaraan + pelanggan for list display
        $db = \Config\Database::connect();
        $data['trans'] = $db->query("
            SELECT t.*, k.No_Polisi, k.Merk, k.Tipe, p.Nama_Lengkap
            FROM transaksi t
            LEFT JOIN kendaraan k ON t.ID_Kendaraan = k.ID_Kendaraan
            LEFT JOIN pelanggan p ON k.ID_Pelanggan = p.ID_Pelanggan
            ORDER BY t.ID_Transaksi DESC
        ")->getResultArray();
        return view('transaksi/list', $data);
    }

    public function create() {
        $data['title'] = 'Transaksi Baru';
        $data['kendaraan'] = $this->kendModel->findAll();
        $data['jasaList'] = (new JasaModel())->findAll();
        $data['sparepartList'] = (new SparepartModel())->findAll();
        return view('transaksi/create', $data);
    }

    public function store() {
        $servisIds = $this->request->getPost('servis_id') ?? [];
        $servisHarga = $this->request->getPost('servis_harga') ?? [];
        $sparepartIds = $this->request->getPost('sparepart_id') ?? [];
        $sparepartJml = $this->request->getPost('sparepart_jumlah') ?? [];
        $sparepartHrg = $this->request->getPost('sparepart_harga') ?? [];

        // Calculate total
        $total = 0;
        foreach ($servisHarga as $h) $total += (float)$h;
        foreach ($sparepartHrg as $i => $h) $total += (float)$h * (int)($sparepartJml[$i] ?? 1);

        // Save transaksi
        $this->transModel->save([
            'ID_User'       => session()->get('ID_User'),
            'ID_Kendaraan'  => $this->request->getPost('ID_Kendaraan'),
            'Tanggal_Masuk' => date('Y-m-d H:i:s'),
            'Keluhan'       => $this->request->getPost('Keluhan'),
            'Total_Harga'   => $total,
        ]);
        $transId = $this->transModel->getInsertID();

        // Save detail servis
        $detServis = new DetailServisModel();
        foreach ($servisIds as $i => $jasaId) {
            if (!empty($jasaId)) {
                $detServis->insert([
                    'ID_Transaksi' => $transId,
                    'ID_Jasa'      => $jasaId,
                    'Harga_Satuan' => $servisHarga[$i] ?? 0,
                ]);
            }
        }

        // Save detail sparepart + kurangi stok
        $detSparepart = new DetailSparepartModel();
        $sparepartModel = new SparepartModel();

        // Validasi stok dulu sebelum proses
        foreach ($sparepartIds as $i => $spId) {
            if (!empty($spId)) {
                $jml = (int)($sparepartJml[$i] ?? 1);
                $sp = $sparepartModel->find($spId);
                if (!$sp || $sp['Stok_Barang'] < $jml) {
                    // Hapus transaksi yang sudah dibuat & detail servis
                    $db = \Config\Database::connect();
                    $db->query("DELETE FROM detail_servis WHERE ID_Transaksi = ?", [$transId]);
                    $this->transModel->delete($transId);
                    return redirect()->back()->with('error', 'Stok sparepart "' . ($sp['Nama_Barang'] ?? '') . '" tidak mencukupi (sisa: ' . ($sp['Stok_Barang'] ?? 0) . ').');
                }
            }
        }

        foreach ($sparepartIds as $i => $spId) {
            if (!empty($spId)) {
                $jml = (int)($sparepartJml[$i] ?? 1);
                $detSparepart->insert([
                    'ID_Transaksi' => $transId,
                    'ID_Sparepart' => $spId,
                    'Jumlah'       => $jml,
                    'Harga_Satuan' => $sparepartHrg[$i] ?? 0,
                ]);
                // Kurangi stok
                $db = \Config\Database::connect();
                $db->query("UPDATE sparepart SET Stok_Barang = Stok_Barang - ? WHERE ID_Sparepart = ?", [$jml, $spId]);
            }
        }

        (new NotifikasiModel())->insert([
            'pesan' => 'Transaksi #' . $transId . ' dibuat — Total: Rp ' . number_format($total, 0, ',', '.'),
            'tipe'  => 'success',
            'icon'  => 'bx-receipt',
        ]);

        return redirect()->to('/transaksi/' . $transId)->with('success', 'Transaksi berhasil dibuat!');
    }

    public function show($id) {
        $data['title'] = 'Detail Transaksi';
        $data['trans'] = $this->transModel->find($id);
        if (!$data['trans']) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Kendaraan + Pelanggan
        $data['kendaraan'] = $this->kendModel->find($data['trans']['ID_Kendaraan']);
        if ($data['kendaraan']) {
            $data['pelanggan'] = (new PelangganModel())->find($data['kendaraan']['ID_Pelanggan']);
        } else {
            $data['pelanggan'] = null;
        }

        // Detail servis with jasa names
        $db = \Config\Database::connect();
        $data['detailServis'] = $db->query("
            SELECT ds.*, j.Nama_Jasa 
            FROM detail_servis ds
            LEFT JOIN jasa j ON ds.ID_Jasa = j.ID_Jasa
            WHERE ds.ID_Transaksi = ?
        ", [$id])->getResultArray();

        // Detail sparepart with names
        $data['detailSparepart'] = $db->query("
            SELECT dp.*, s.Nama_Barang 
            FROM detail_sparepart dp
            LEFT JOIN sparepart s ON dp.ID_Sparepart = s.ID_Sparepart
            WHERE dp.ID_Transaksi = ?
        ", [$id])->getResultArray();

        return view('transaksi/detail', $data);
    }

    public function edit($id) {
        $data['title'] = 'Edit Transaksi';
        $data['trans'] = $this->transModel->find($id);
        if (!$data['trans']) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        $data['kendaraan'] = $this->kendModel->findAll();
        $data['jasaList'] = (new JasaModel())->findAll();
        $data['sparepartList'] = (new SparepartModel())->findAll();

        $db = \Config\Database::connect();
        $data['detailServis'] = $db->query("
            SELECT ds.*, j.Nama_Jasa 
            FROM detail_servis ds
            LEFT JOIN jasa j ON ds.ID_Jasa = j.ID_Jasa
            WHERE ds.ID_Transaksi = ?
        ", [$id])->getResultArray();

        $data['detailSparepart'] = $db->query("
            SELECT dp.*, s.Nama_Barang 
            FROM detail_sparepart dp
            LEFT JOIN sparepart s ON dp.ID_Sparepart = s.ID_Sparepart
            WHERE dp.ID_Transaksi = ?
        ", [$id])->getResultArray();

        return view('transaksi/edit', $data);
    }

    public function update($id) {
        $db = \Config\Database::connect();

        // Kembalikan stok sparepart lama
        $oldParts = $db->query("SELECT * FROM detail_sparepart WHERE ID_Transaksi = ?", [$id])->getResultArray();
        foreach ($oldParts as $op) {
            $db->query("UPDATE sparepart SET Stok_Barang = Stok_Barang + ? WHERE ID_Sparepart = ?", [$op['Jumlah'], $op['ID_Sparepart']]);
        }

        // Hapus detail lama
        $db->query("DELETE FROM detail_servis WHERE ID_Transaksi = ?", [$id]);
        $db->query("DELETE FROM detail_sparepart WHERE ID_Transaksi = ?", [$id]);

        // Hitung total baru
        $servisIds = $this->request->getPost('servis_id') ?? [];
        $servisHarga = $this->request->getPost('servis_harga') ?? [];
        $sparepartIds = $this->request->getPost('sparepart_id') ?? [];
        $sparepartJml = $this->request->getPost('sparepart_jumlah') ?? [];
        $sparepartHrg = $this->request->getPost('sparepart_harga') ?? [];

        $total = 0;
        foreach ($servisHarga as $h) $total += (float)$h;
        foreach ($sparepartHrg as $i => $h) $total += (float)$h * (int)($sparepartJml[$i] ?? 1);

        // Update transaksi
        $this->transModel->update($id, [
            'ID_Kendaraan'  => $this->request->getPost('ID_Kendaraan'),
            'Keluhan'       => $this->request->getPost('Keluhan'),
            'Total_Harga'   => $total,
        ]);

        // Simpan detail servis baru
        $detServis = new DetailServisModel();
        foreach ($servisIds as $i => $jasaId) {
            if (!empty($jasaId)) {
                $detServis->insert([
                    'ID_Transaksi' => $id,
                    'ID_Jasa'      => $jasaId,
                    'Harga_Satuan' => $servisHarga[$i] ?? 0,
                ]);
            }
        }

        // Simpan detail sparepart baru + kurangi stok
        $detSparepart = new DetailSparepartModel();
        $sparepartModel = new SparepartModel();

        // Validasi stok dulu sebelum proses
        foreach ($sparepartIds as $i => $spId) {
            if (!empty($spId)) {
                $jml = (int)($sparepartJml[$i] ?? 1);
                $sp = $sparepartModel->find($spId);
                if (!$sp || $sp['Stok_Barang'] < $jml) {
                    return redirect()->back()->with('error', 'Stok sparepart "' . ($sp['Nama_Barang'] ?? '') . '" tidak mencukupi (sisa: ' . ($sp['Stok_Barang'] ?? 0) . ').');
                }
            }
        }

        foreach ($sparepartIds as $i => $spId) {
            if (!empty($spId)) {
                $jml = (int)($sparepartJml[$i] ?? 1);
                $detSparepart->insert([
                    'ID_Transaksi' => $id,
                    'ID_Sparepart' => $spId,
                    'Jumlah'       => $jml,
                    'Harga_Satuan' => $sparepartHrg[$i] ?? 0,
                ]);
                $db->query("UPDATE sparepart SET Stok_Barang = Stok_Barang - ? WHERE ID_Sparepart = ?", [$jml, $spId]);
            }
        }

        (new NotifikasiModel())->insert([
            'pesan' => 'Transaksi #' . $id . ' diperbarui — Total: Rp ' . number_format($total, 0, ',', '.'),
            'tipe'  => 'info',
            'icon'  => 'bx-edit',
        ]);

        return redirect()->to('/transaksi/' . $id)->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function bayar($id) {
        $trans = $this->transModel->find($id);
        if (!$trans) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }
        if (($trans['Status_Bayar'] ?? '') === 'Lunas') {
            return redirect()->to('/transaksi/' . $id)->with('error', 'Transaksi sudah lunas.');
        }
        $this->transModel->update($id, ['Status_Bayar' => 'Lunas']);
        (new NotifikasiModel())->insert(['pesan' => 'Transaksi #' . $id . ' ditandai lunas', 'tipe' => 'success', 'icon' => 'bx-check-circle']);
        return redirect()->to('/transaksi/' . $id)->with('success', 'Pembayaran berhasil!');
    }

    public function delete($id) {
        $trans = $this->transModel->find($id);
        if (!$trans) {
            return redirect()->to('/transaksi')->with('error', 'Transaksi tidak ditemukan.');
        }

        $db = \Config\Database::connect();

        // Kembalikan stok sparepart jika statusnya bukan Batal (karena Batal sudah dikembalikan)
        if (($trans['Status_Bayar'] ?? '') != 'Batal') {
            $details = $db->query("SELECT * FROM detail_sparepart WHERE ID_Transaksi = ?", [$id])->getResultArray();
            foreach ($details as $dp) {
                $db->query("UPDATE sparepart SET Stok_Barang = Stok_Barang + ? WHERE ID_Sparepart = ?", [$dp['Jumlah'], $dp['ID_Sparepart']]);
            }
        }

        // Hapus detail servis & sparepart
        $db->query("DELETE FROM detail_servis WHERE ID_Transaksi = ?", [$id]);
        $db->query("DELETE FROM detail_sparepart WHERE ID_Transaksi = ?", [$id]);

        // Hapus transaksi
        $this->transModel->delete($id);

        (new NotifikasiModel())->insert([
            'pesan' => 'Transaksi #' . $id . ' dihapus',
            'tipe'  => 'danger',
            'icon'  => 'bx-trash',
        ]);

        return redirect()->to('/transaksi')->with('success', 'Transaksi berhasil dihapus.');
    }

    // --- API Endpoints ---
    public function getPelanggan($idKendaraan) {
        $kend = $this->kendModel->find($idKendaraan);
        if ($kend) {
            $pel = (new PelangganModel())->find($kend['ID_Pelanggan']);
            return $this->response->setJSON($pel ?? ['error' => 'not found']);
        }
        return $this->response->setJSON(['error' => 'not found']);
    }
}