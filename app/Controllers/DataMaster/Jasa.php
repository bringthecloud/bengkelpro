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
        if (session()->get('role') !== 'admin') return redirect()->to('/jasa')->with('error', 'Anda tidak memiliki akses.');
        return view('master/jasa_form', ['title'=>'Tambah Jasa']); 
    }

    public function create() {
        if (session()->get('role') !== 'admin') return redirect()->to('/jasa')->with('error', 'Anda tidak memiliki akses.');
        $this->model->insert($this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Jasa "' . $this->request->getPost('Nama_Jasa') . '" ditambahkan', 'tipe' => 'success', 'icon' => 'bx-wrench']);
        return redirect()->to('/jasa')->with('success', 'Jasa berhasil ditambah');
    }

    public function edit($id = null) {
        if (session()->get('role') !== 'admin') return redirect()->to('/jasa')->with('error', 'Anda tidak memiliki akses.');
        $data['title'] = 'Edit Jasa';
        $data['item'] = $this->model->find($id);
        if (!$data['item']) return redirect()->to('/jasa');
        
        return view('master/jasa_form', $data);
    }

    public function update($id = null) {
        if (session()->get('role') !== 'admin') return redirect()->to('/jasa')->with('error', 'Anda tidak memiliki akses.');
        $this->model->update($id, $this->request->getPost());
        (new NotifikasiModel())->insert(['pesan' => 'Jasa "' . $this->request->getPost('Nama_Jasa') . '" diperbarui', 'tipe' => 'info', 'icon' => 'bx-edit']);
        return redirect()->to('/jasa')->with('success', 'Jasa diupdate');
    }

    public function delete($id = null) {
        if (session()->get('role') !== 'admin') return redirect()->to('/jasa')->with('error', 'Anda tidak memiliki akses.');
        $item = $this->model->find($id);
        $this->model->delete($id);
        (new NotifikasiModel())->insert(['pesan' => 'Jasa "' . ($item['Nama_Jasa'] ?? '') . '" dihapus', 'tipe' => 'danger', 'icon' => 'bx-trash']);
        return redirect()->to('/jasa')->with('success', 'Jasa dihapus');
    }
}