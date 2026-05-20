<?php 

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JasaSeeder extends Seeder
{
    public function run()
    {
        // 1. Paksa matikan foreign key check sebentar biar bisa dikosongkan tanpa eror
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0;');
        
        // 2. Bersihkan tabel detail transaksi servis dan tabel induk jasa
        $this->db->table('detail_servis')->truncate(); // sesuaikan jika nama tabel detail servis kamu berbeda
        $this->db->table('jasa')->truncate();
        
        // 3. Hidupkan kembali foreign key check
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1;');

        // 4. Data Jasa Bengkel Lengkap (Motor & Mobil) sesuai standar tarif real
        $data = [
            // --- Kategori: Oli & Cairan ---
            [
                'Nama_Jasa'      => 'Ganti Oli Mesin',
                'Harga_Satuan'   => 15000,
                'Deskripsi'      => 'Jasa penggantian oli mesin (Motor/Mobil standar)',
                'Estimasi_Waktu' => 15,
            ],
            [
                'Nama_Jasa'      => 'Ganti Oli Gardan / Transmisi',
                'Harga_Satuan'   => 15000,
                'Deskripsi'      => 'Jasa kuras dan ganti oli gardan matic atau oli transmisi',
                'Estimasi_Waktu' => 15,
            ],
            [
                'Nama_Jasa'      => 'Kuras Minyak Rem & Bleeding',
                'Harga_Satuan'   => 35000,
                'Deskripsi'      => 'Kuras minyak rem lama dan pembuangan angin palsu pada sistem rem',
                'Estimasi_Waktu' => 30,
            ],

            // --- Kategori: Servis Berkala & Tune Up ---
            [
                'Nama_Jasa'      => 'Service Ringan / Tune Up Motor Matik',
                'Harga_Satuan'   => 45000,
                'Deskripsi'      => 'Pembersihan filter udara, cek busi, setel pengereman, dan reset injeksi',
                'Estimasi_Waktu' => 30,
            ],
            [
                'Nama_Jasa'      => 'Service CVT Lengkap (Motor Matik)',
                'Harga_Satuan'   => 40000,
                'Deskripsi'      => 'Bongkar bak CVT, pembersihan roller, pulley, kampas ganda, dan pemberian grease baru',
                'Estimasi_Waktu' => 45,
            ],
            [
                'Nama_Jasa'      => 'Tune Up Engine Mobil (Bensin/Diesel)',
                'Harga_Satuan'   => 150000,
                'Deskripsi'      => 'Pembersihan throttle body/karburator, cek busi, scanner ECU, dan gurah mesin ringan',
                'Estimasi_Waktu' => 60,
            ],

            // --- Kategori: Kaki-Kaki, Rem, & Roda ---
            [
                'Nama_Jasa'      => 'Ganti Kampas Rem (Per Roda)',
                'Harga_Satuan'   => 25000,
                'Deskripsi'      => 'Jasa bongkar pasang kampas rem cakram atau tromol',
                'Estimasi_Waktu' => 20,
            ],
            [
                'Nama_Jasa'      => 'Ganti Ban Motor (Tubeless/Ban Dalam)',
                'Harga_Satuan'   => 20000,
                'Deskripsi'      => 'Jasa bongkar pasang ban menggunakan mesin Tyre Changer atau manual',
                'Estimasi_Waktu' => 20,
            ],
            [
                'Nama_Jasa'      => 'Spooring & Balancing Mobil',
                'Harga_Satuan'   => 175000,
                'Deskripsi'      => 'Penyelarasan sudut kelurusan roda dan penyeimbangan berat putaran roda mobil',
                'Estimasi_Waktu' => 60,
            ],
            [
                'Nama_Jasa'      => 'Ganti Shockbreaker Belakang (Motor)',
                'Harga_Satuan'   => 35000,
                'Deskripsi'      => 'Jasa bongkar pasang peredam kejut bagian belakang',
                'Estimasi_Waktu' => 30,
            ],

            // --- Kategori: Kelistrikan & Sistem AC ---
            [
                'Nama_Jasa'      => 'Ganti Aki / Battery Check',
                'Harga_Satuan'   => 10000,
                'Deskripsi'      => 'Jasa pasang aki baru dan pengecekan tegangan pengisian kiprok/alternator',
                'Estimasi_Waktu' => 10,
            ],
            [
                'Nama_Jasa'      => 'Service AC Mobil Ringan (Cleaning)',
                'Harga_Satuan'   => 200000,
                'Deskripsi'      => 'Pembersihan blower, filter kabin, spray kondensor, dan isi ulang freon',
                'Estimasi_Waktu' => 90,
            ],

            // --- Kategori: Perbaikan Besar (Overhaul) ---
            [
                'Nama_Jasa'      => 'Turun Mesin / Overhaul Motor',
                'Harga_Satuan'   => 300000,
                'Deskripsi'      => 'Bongkar total mesin untuk penggantian piston, stang seher, atau skir klep bocor',
                'Estimasi_Waktu' => 240,
            ],
        ];

        // 5. Eksekusi insert semua data ke database
        $this->db->table('jasa')->insertBatch($data);
    }
}