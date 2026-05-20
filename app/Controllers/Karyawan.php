<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\NotifikasiModel;

class Karyawan extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new UserModel();
        // Block non-admin access
        if (session()->get('role') !== 'admin') {
            header('Location: /dashboard');
            exit;
        }
    }

    public function index() {
        $data['title'] = 'Data Karyawan';
        $data['items'] = $this->model->findAll();
        return view('karyawan/list', $data);
    }

    public function new() {
        return view('karyawan/form', ['title' => 'Tambah Karyawan']);
    }

    public function create() {
        $this->model->insert([
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ]);
        (new NotifikasiModel())->insert(['pesan' => 'Karyawan baru "' . $this->request->getPost('nama') . '" ditambahkan', 'tipe' => 'success', 'icon' => 'bx-user-plus']);
        return redirect()->to('/karyawan')->with('success', 'Karyawan berhasil ditambah');
    }

    public function edit($id = null) {
        $data['title'] = 'Edit Karyawan';
        $data['item'] = $this->model->find($id);
        if (!$data['item']) return redirect()->to('/karyawan');
        return view('karyawan/form', $data);
    }

    public function update($id = null) {
        $updateData = [
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role'),
        ];
        // Only update password if provided
        $newPass = $this->request->getPost('password');
        if (!empty($newPass)) {
            $updateData['password'] = password_hash($newPass, PASSWORD_DEFAULT);
        }
        $this->model->update($id, $updateData);
        (new NotifikasiModel())->insert(['pesan' => 'Data karyawan "' . $this->request->getPost('nama') . '" diperbarui', 'tipe' => 'info', 'icon' => 'bx-edit']);
        return redirect()->to('/karyawan')->with('success', 'Data karyawan diperbarui');
    }

    public function delete($id = null) {
        $item = $this->model->find($id);
        if ($item && $item['username'] === 'admin') {
            return redirect()->to('/karyawan')->with('error', 'Akun admin utama tidak bisa dihapus');
        }
        $this->model->delete($id);
        (new NotifikasiModel())->insert(['pesan' => 'Karyawan "' . ($item['nama'] ?? '') . '" dihapus', 'tipe' => 'danger', 'icon' => 'bx-user-minus']);
        return redirect()->to('/karyawan')->with('success', 'Karyawan dihapus');
    }
}
