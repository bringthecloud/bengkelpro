<?php namespace App\Controllers\DataMaster;

use App\Models\JasaModel;
use App\Models\NotifikasiModel;
use App\Controllers\BaseController;

class Jasa extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new JasaModel();
    }

    public function index() {
        $data['title'] = 'Data Jasa Service';
        $data['items'] = $this->model->findAll();
        return view('master/jasa_list', $data);
    }

    public function new() { 
        return view('master/jasa_form', ['title'=>'Tambah Jasa']); 
    }

    public function create() {
        $this->model->insert($this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Jasa "' . $this->request->getPost('Nama_Jasa') . '" ditambahkan', 'tipe' => 'success', 'icon' => 'bx-wrench']);
        return redirect()->to('/jasa')->with('success', 'Jasa berhasil ditambah');
    }

    public function edit($id = null) {
        $data['title'] = 'Edit Jasa';
        $data['item'] = $this->model->find($id);
        if (!$data['item']) return redirect()->to('/jasa');
        
        return view('master/jasa_form', $data);
    }

    public function update($id = null) {
        $this->model->update($id, $this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Jasa "' . $this->request->getPost('Nama_Jasa') . '" diperbarui', 'tipe' => 'info', 'icon' => 'bx-edit']);
        return redirect()->to('/jasa')->with('success', 'Jasa diupdate');
    }

    public function delete($id = null) {
        $item = $this->model->find($id);
        $this->model->delete($id);
        (new NotifikasiModel())->insert(['pesan' => 'Jasa "' . ($item['Nama_Jasa'] ?? '') . '" dihapus', 'tipe' => 'danger', 'icon' => 'bx-trash']);
        return redirect()->to('/jasa')->with('success', 'Jasa dihapus');
    }
}