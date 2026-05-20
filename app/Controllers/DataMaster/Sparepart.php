<?php namespace App\Controllers\DataMaster;

use App\Models\SparepartModel;
use App\Models\NotifikasiModel;
use App\Controllers\BaseController;

class Sparepart extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new SparepartModel();
    }

    public function index() {
        $data['title'] = 'Data Sparepart';
        $data['items'] = $this->model->findAll();
        return view('master/sparepart_list', $data);
    }

    public function new() { 
        return view('master/sparepart_form', ['title'=>'Tambah Sparepart']); 
    }

    public function create() {
        $this->model->insert($this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Sparepart "' . $this->request->getPost('Nama_Barang') . '" ditambahkan', 'tipe' => 'success', 'icon' => 'bxs-box']);
        return redirect()->to('/sparepart')->with('success', 'Sparepart ditambah');
    }

    public function edit($id = null) {
        $data['title'] = 'Edit Sparepart';
        $data['item'] = $this->model->find($id);
        if (!$data['item']) return redirect()->to('/sparepart');
        
        return view('master/sparepart_form', $data);
    }

    public function update($id = null) {
        $this->model->update($id, $this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Sparepart "' . $this->request->getPost('Nama_Barang') . '" diperbarui', 'tipe' => 'info', 'icon' => 'bx-edit']);
        return redirect()->to('/sparepart')->with('success', 'Sparepart diupdate');
    }

    public function delete($id = null) {
        $item = $this->model->find($id);
        $this->model->delete($id);
        (new NotifikasiModel())->insert(['pesan' => 'Sparepart "' . ($item['Nama_Barang'] ?? '') . '" dihapus', 'tipe' => 'danger', 'icon' => 'bx-trash']);
        return redirect()->to('/sparepart')->with('success', 'Sparepart dihapus');
    }
}