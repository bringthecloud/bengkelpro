<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        // Must be logged in first
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        // Must be admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
