<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

        // Pengecekan sesi: pastikan pengguna sudah login dan rolenya adalah 'user'
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'user') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai User untuk mengakses halaman ini.');
            redirect(base_url());
        }
    }

    public function index()
    {
        redirect('user/dashboard');
    }

    public function dashboard()
    {
        $user_id = $this->session->userdata('user_id');
        
        // 1. Mengambil data utama
        $data['balance'] = $this->User_model->get_user_balance($user_id);
        $data['total_waste'] = $this->User_model->get_total_waste_by_user($user_id);
        $data['transactions'] = $this->User_model->get_user_transactions($user_id, 5); // Ambil 5 transaksi terakhir

        // 2. Mengambil data untuk grafik komposisi sampah
        $waste_summary = $this->User_model->get_waste_summary_by_user($user_id);
        
        // Memformat data agar siap digunakan oleh Chart.js
        $data['waste_labels'] = json_encode(array_column($waste_summary, 'waste_type'));
        $data['waste_data'] = json_encode(array_column($waste_summary, 'total_weight'));

        // 3. Logika untuk status iuran (contoh statis)
        // Di aplikasi nyata, Anda akan memeriksa status pembayaran dari database.
        // Untuk saat ini, kita buat contoh statis.
        $data['iuran'] = [
            'status' => 'paid', // Ganti menjadi 'unpaid' untuk melihat perbedaannya
            'amount' => 20000,
            'due_date' => '30 Oktober 2025'
        ];

        $data['view_name'] = 'user/dashboard'; 
        $this->load->view('user/layout', $data);
    }

    public function transactions()
    {
        $user_id = $this->session->userdata('user_id');

        // Mengambil data untuk kartu rekapitulasi
        $data['total_transactions'] = $this->User_model->count_user_transactions($user_id);
        $data['total_income'] = $this->User_model->get_total_income_by_user($user_id);
        $data['total_waste'] = $this->User_model->get_total_waste_by_user($user_id);

        // Mengambil daftar semua transaksi untuk ditampilkan di tabel
        $data['transactions'] = $this->User_model->get_user_transactions($user_id);
        
        $data['view_name'] = 'user/transactions';
        $this->load->view('user/layout', $data);
    }

    public function waste_banks()
    {
        $data['agents'] = $this->User_model->get_all_active_agents();
        $data['view_name'] = 'user/waste_banks';
        $this->load->view('user/layout', $data);
    }

    public function profile()
    {
        $user_id = $this->session->userdata('user_id');

        // Proses update jika ada form POST
        if ($this->input->post()) {
            $update_data = [
                'nama'      => $this->input->post('name'),
                'phone'     => $this->input->post('phone'),
                'address'   => $this->input->post('address'), // Tetap simpan alamat teks
                'bio'       => $this->input->post('bio'),
                // PERUBAHAN: Simpan latitude dan longitude
                'latitude'  => $this->input->post('latitude') ?: NULL,
                'longitude' => $this->input->post('longitude') ?: NULL,
            ];

            // Hanya update password jika diisi
            if ($this->input->post('password')) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }

            if ($this->User_model->update_profile($user_id, $update_data)) {
                // Update session juga agar nama di header berubah
                $this->session->set_userdata('name', $update_data['nama']);
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }
            redirect('user/profile');
        }

        // Menyiapkan data untuk ditampilkan di view
        $user_profile = $this->User_model->get_user_profile($user_id);

        // PERUBAHAN: Logika untuk menampilkan alamat
        $this->load->helper('location');
        $address_display = 'Belum diisi';
        if (!empty($user_profile['latitude']) && !empty($user_profile['longitude'])) {
        // Prioritaskan konversi dari koordinat
        $address_display = get_address_from_coords($user_profile['latitude'], $user_profile['longitude']);
        } elseif (!empty($user_profile['address'])) {
            // Jika koordinat tidak ada, pakai alamat teks
            $address_display = $user_profile['address'];
        }

        $data['user'] = [
            'name'         => $user_profile['nama'],
            'role'         => ucfirst($user_profile['role']),
            'email'        => $user_profile['email'],
            'phone'        => !empty($user_profile['phone']) ? $user_profile['phone'] : 'Belum diisi',
            // PERUBAHAN: Gunakan variabel yang sudah disiapkan
            'address'      => $address_display,
            // Tambahkan latitude dan longitude untuk diisi di form
            'latitude'     => $user_profile['latitude'],
            'longitude'    => $user_profile['longitude'],
            'raw_address'  => $user_profile['address'], // Kirim alamat asli untuk form
            'bio'          => !empty($user_profile['bio']) ? $user_profile['bio'] : 'Ceritakan tentang diri Anda.',
            'member_since' => date('M Y', strtotime($user_profile['created_at'])),
        ];

        $data['stats'] = [
            'collections'     => $this->User_model->count_user_transactions($user_id),
            'points'          => $this->User_model->get_user_points($user_id),
            'waste_collected' => $this->User_model->get_total_waste_by_user($user_id),
        ];

        $data['view_name'] = 'user/profile';
        $this->load->view('user/layout', $data);
    }
}

