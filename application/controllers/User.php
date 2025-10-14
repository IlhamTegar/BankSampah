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
        
        $data['balance'] = $this->User_model->get_user_balance($user_id);
        $data['transactions'] = $this->User_model->get_user_transactions($user_id, 5);
        $data['total_transactions'] = $this->User_model->count_user_transactions($user_id);

        $data['view_name'] = 'user/dashboard'; 
        $this->load->view('user/layout', $data);
    }

    public function transactions()
    {
        $user_id = $this->session->userdata('user_id');
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
                'nama'    => $this->input->post('name'),
                'email'   => $this->input->post('email'),
                'phone'   => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'bio'     => $this->input->post('bio'),
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

        $data['user'] = [
            'name'         => $user_profile['nama'],
            'role'         => ucfirst($user_profile['role']),
            'email'        => $user_profile['email'],
            'phone'        => $user_profile['phone'] ?? 'Belum diisi',
            'address'      => $user_profile['address'] ?? 'Belum diisi',
            'bio'          => $user_profile['bio'] ?? 'Ceritakan tentang diri Anda.',
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

