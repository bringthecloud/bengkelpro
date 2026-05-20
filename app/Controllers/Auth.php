<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController {
    public function index() {
        return view('auth/login', ['title'=>'Login']);
    }
    public function login() {
        $model = new UserModel();
        $user = $model->where('username', $this->request->getPost('username'))->first();
        if($user && password_verify($this->request->getPost('password'), $user['password'])){
            session()->set([
                'ID_User'     => $user['ID_User'],
                'nama'        => $user['nama'],
                'role'        => $user['role'] ?? 'kasir',
                'isLoggedIn'  => TRUE,
            ]);
            return redirect()->to('/dashboard');
        }
        return redirect()->back()->with('error', 'Username/Password salah');
    }
    public function logout() { session()->destroy(); return redirect()->to('/login'); }
}