<?php namespace App\Controllers\DataMaster;

use App\Models\KendaraanModel;
use App\Models\PelangganModel;
use App\Models\NotifikasiModel;
use App\Controllers\BaseController;

class Kendaraan extends BaseController {
    protected $kendaraanModel;

    public function __construct() {
        $this->kendaraanModel = new KendaraanModel();
    }

    public function index() {
        $data['title'] = 'Data Kendaraan';
        $data['items'] = $this->kendaraanModel->findAll();
        return view('master/kendaraan_list', $data);
    }

    public function new() { 
        $pelangganModel = new PelangganModel();
        $data['title'] = 'Tambah Kendaraan';
        $data['pelanggan'] = $pelangganModel->findAll();
        return view('master/kendaraan_form', $data); 
    }

    public function create() {
        $this->kendaraanModel->insert($this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Kendaraan "' . $this->request->getPost('No_Polisi') . '" ditambahkan', 'tipe' => 'success', 'icon' => 'bxs-car']);
        return redirect()->to('/kendaraan')->with('success', 'Kendaraan berhasil ditambah');
    }

    public function edit($id = null) {
        $data['title'] = 'Edit Kendaraan';
        $data['item'] = $this->kendaraanModel->find($id);
        
        $pelangganModel = new PelangganModel();
        $data['pelanggan'] = $pelangganModel->findAll();

        if (!$data['item']) return redirect()->to('/kendaraan');
        
        return view('master/kendaraan_form', $data);
    }

    public function update($id = null) {
        $this->kendaraanModel->update($id, $this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Kendaraan "' . $this->request->getPost('No_Polisi') . '" diperbarui', 'tipe' => 'info', 'icon' => 'bx-edit']);
        return redirect()->to('/kendaraan')->with('success', 'Data Kendaraan diupdate');
    }

    public function delete($id = null) {
        $item = $this->kendaraanModel->find($id);
        $this->kendaraanModel->delete($id);
        (new NotifikasiModel())->insert(['pesan' => 'Kendaraan "' . ($item['No_Polisi'] ?? '') . '" dihapus', 'tipe' => 'danger', 'icon' => 'bx-trash']);
        return redirect()->to('/kendaraan')->with('success', 'Kendaraan dihapus');
    }
}