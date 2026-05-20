<?php namespace App\Controllers;

use App\Models\NotifikasiModel;

class Notifikasi extends BaseController {
    protected $model;

    public function __construct() {
        $this->model = new NotifikasiModel();
    }

    public function index() {
        // Mark all as read when viewing
        $this->model->where('is_read', 0)->set('is_read', 1)->update();

        $data['title'] = 'Notifikasi';
        $data['items'] = $this->model->orderBy('created_at', 'DESC')->findAll(50);
        return view('notifikasi/index', $data);
    }

    public function clear() {
        $this->model->truncate();
        return redirect()->to('/notifikasi')->with('success', 'Semua notifikasi dihapus');
    }
}
