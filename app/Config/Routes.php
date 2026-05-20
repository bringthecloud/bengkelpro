<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get('/', 'Home::index');
 $routes->get('/login', 'Auth::index');
 $routes->match(['get', 'post'], '/auth/login', 'Auth::login');
 $routes->get('/auth/logout', 'Auth::logout');

 $routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    
    // --- ROUTES UNTUK DATA MASTER ---
    
    // Pelanggan
    $routes->get('/pelanggan', 'DataMaster\Pelanggan::index');
    $routes->get('/pelanggan/new', 'DataMaster\Pelanggan::new');
    $routes->post('/pelanggan/create', 'DataMaster\Pelanggan::create');
    $routes->get('/pelanggan/edit/(:num)', 'DataMaster\Pelanggan::edit/$1');
    $routes->post('/pelanggan/update/(:num)', 'DataMaster\Pelanggan::update/$1');
    $routes->get('/pelanggan/delete/(:num)', 'DataMaster\Pelanggan::delete/$1');

    // Kendaraan
    $routes->get('/kendaraan', 'DataMaster\Kendaraan::index');
    $routes->get('/kendaraan/new', 'DataMaster\Kendaraan::new');
    $routes->post('/kendaraan/create', 'DataMaster\Kendaraan::create');
    $routes->get('/kendaraan/edit/(:num)', 'DataMaster\Kendaraan::edit/$1');
    $routes->post('/kendaraan/update/(:num)', 'DataMaster\Kendaraan::update/$1');
    $routes->get('/kendaraan/delete/(:num)', 'DataMaster\Kendaraan::delete/$1');

    // Jasa
    $routes->get('/jasa', 'DataMaster\Jasa::index');
    $routes->get('/jasa/new', 'DataMaster\Jasa::new');
    $routes->post('/jasa/create', 'DataMaster\Jasa::create');
    $routes->get('/jasa/edit/(:num)', 'DataMaster\Jasa::edit/$1');
    $routes->post('/jasa/update/(:num)', 'DataMaster\Jasa::update/$1');
    $routes->get('/jasa/delete/(:num)', 'DataMaster\Jasa::delete/$1');

    // Sparepart
    $routes->get('/sparepart', 'DataMaster\Sparepart::index');
    $routes->get('/sparepart/new', 'DataMaster\Sparepart::new');
    $routes->post('/sparepart/create', 'DataMaster\Sparepart::create');
    $routes->get('/sparepart/edit/(:num)', 'DataMaster\Sparepart::edit/$1');
    $routes->post('/sparepart/update/(:num)', 'DataMaster\Sparepart::update/$1');
    $routes->get('/sparepart/delete/(:num)', 'DataMaster\Sparepart::delete/$1');

    // Transaksi
    $routes->get('/transaksi', 'Transaksi::index');
    $routes->get('/transaksi/create', 'Transaksi::create');
    $routes->post('/transaksi', 'Transaksi::store');
    $routes->get('/transaksi/getpelanggan/(:num)', 'Transaksi::getPelanggan/$1');
    $routes->get('/transaksi/bayar/(:num)', 'Transaksi::bayar/$1');
    $routes->get('/transaksi/edit/(:num)', 'Transaksi::edit/$1');
    $routes->post('/transaksi/update/(:num)', 'Transaksi::update/$1');
    $routes->get('/transaksi/delete/(:num)', 'Transaksi::delete/$1');
    $routes->get('/transaksi/(:num)', 'Transaksi::show/$1');

    // Laporan
    $routes->get('/laporan', 'Laporan::index');

    // Notifikasi
    $routes->get('/notifikasi', 'Notifikasi::index');
    $routes->get('/notifikasi/clear', 'Notifikasi::clear');

    // Karyawan (admin only)
    $routes->group('', ['filter' => 'adminOnly'], function($routes) {
        $routes->get('/karyawan', 'Karyawan::index');
        $routes->get('/karyawan/new', 'Karyawan::new');
        $routes->post('/karyawan/create', 'Karyawan::create');
        $routes->get('/karyawan/edit/(:num)', 'Karyawan::edit/$1');
        $routes->post('/karyawan/update/(:num)', 'Karyawan::update/$1');
        $routes->get('/karyawan/delete/(:num)', 'Karyawan::delete/$1');
    });
});