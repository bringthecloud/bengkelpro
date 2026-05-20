<?php namespace App\Controllers\DataMaster;

use App\Models\PelangganModel;
use App\Models\NotifikasiModel;
use App\Controllers\BaseController;

class Pelanggan extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new PelangganModel();
    }

    public function index() {
        $data['title'] = 'Data Pelanggan';
        $data['items'] = $this->model->findAll();
        return view('master/pelanggan_list', $data);
    }

    public function new() { 
        return view('master/pelanggan_form', ['title'=>'Tambah Pelanggan']); 
    }

    public function create() {
        $this->model->insert($this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Pelanggan baru "' . $this->request->getPost('Nama_Lengkap') . '" ditambahkan', 'tipe' => 'success', 'icon' => 'bx-user-plus']);
        return redirect()->to('/pelanggan')->with('success', 'Data Pelanggan berhasil ditambah');
    }

    public function edit($id = null) {
        $data['title'] = 'Edit Pelanggan';
        $data['item'] = $this->model->find($id);
        if (!$data['item']) return redirect()->to('/pelanggan');
        
        return view('master/pelanggan_form', $data);
    }

    public function update($id = null) {
        $this->model->update($id, $this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Data pelanggan "' . $this->request->getPost('Nama_Lengkap') . '" diperbarui', 'tipe' => 'info', 'icon' => 'bx-edit']);
        return redirect()->to('/pelanggan')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id = null) {
        $item = $this->model->find($id);
        $this->model->delete($id);
        (new NotifikasiModel())->insert(['pesan' => 'Pelanggan "' . ($item['Nama_Lengkap'] ?? '') . '" dihapus', 'tipe' => 'danger', 'icon' => 'bx-user-minus']);
        return redirect()->to('/pelanggan')->with('success', 'Data dihapus');
    }
}