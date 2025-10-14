<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');

        $method = $this->uri->segment(2);

        // Jika user BELUM login DAN method yang diakses BUKAN 'login', paksa ke halaman login.
        if (!$this->session->userdata('logged_in') && $method != 'login') {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('admin/login');
        }

        // Jika user SUDAH login TAPI BUKAN admin, tendang ke halaman utama.
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') !== 'admin' && $method != 'login') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses ke halaman ini.');
            redirect(base_url());
        }
    }

    public function login()
    {
        // Jika sudah login sebagai admin, langsung redirect ke dashboard
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'admin') {
            redirect('admin/dashboard');
        }

        // Jika ada data post (form disubmit)
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Kita pakai fungsi get_user_by_email dari Home_model
            $this->load->model('Home_model');
            $user = $this->Home_model->get_user_by_email($email);

            // Validasi: user ada, password cocok, dan role adalah 'admin'
            if ($user && password_verify($password, $user['password']) && $user['role'] === 'admin') {
                // Set session
                $session_data = [
                    'user_id'   => $user['id_user'],
                    'name'      => $user['name'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);
                redirect('admin/dashboard');
            } else {
                // Jika gagal
                $this->session->set_flashdata('error', 'Email atau password salah.');
                redirect('admin/login');
            }
        } else {
            // Jika tidak ada data post, tampilkan view login
            $this->load->view('admin/login');
        }
    }

    public function index()
    {
        redirect('admin/dashboard');
    }
    
    // ... (Semua fungsi dashboard dan manajemen lainnya tetap sama) ...
    public function dashboard()
	{
		// Data untuk Summary Cards
		$data['total_users'] = $this->Admin_model->get_total_users();
		$data['total_agents'] = $this->Admin_model->get_total_agents();
		$data['total_waste'] = $this->Admin_model->get_total_waste_collected();

		// Data untuk tabel persetujuan
		$data['pending_agents'] = $this->Admin_model->get_pending_agents();
		
		// Data untuk grafik
		$monthly_data = $this->Admin_model->get_monthly_waste_trend();
		$data['chart_labels'] = json_encode(array_column($monthly_data, 'month'));
		$data['chart_data'] = json_encode(array_column($monthly_data, 'total'));

		// Data untuk aktivitas terbaru
		$data['recent_transactions'] = $this->Admin_model->get_recent_transactions();
		
		// Tampilkan view
		$data['view_name'] = 'admin/dashboard_content';
		$this->load->view('admin/layout', $data);
	}

	public function approve_agent($id_agent)
	{
		$this->Admin_model->update_agent_status($id_agent, 'aktif');
		$this->session->set_flashdata('success', 'Agen berhasil diaktifkan.');
		redirect('admin/dashboard');
	}

	public function reject_agent($id_agent)
	{
		$this->Admin_model->update_agent_status($id_agent, 'nonaktif');
		$this->session->set_flashdata('success', 'Agen telah dinonaktifkan.');
		redirect('admin/dashboard');
	}

	public function manage_agents()
	{
		$data['agents'] = $this->Admin_model->get_all_agents();
		$data['view_name'] = 'admin/manage_agents_content';
		$this->load->view('admin/layout', $data);
	}

	public function manage_users()
	{
		$data['users'] = $this->Admin_model->get_all_users();
		$data['view_name'] = 'admin/manage_users_content';
		$this->load->view('admin/layout', $data);
	}

	public function waste_types()
	{
		$data['waste_types'] = $this->Admin_model->get_all_waste_types();
		$data['view_name'] = 'admin/waste_types_content';
		$this->load->view('admin/layout', $data);
	}

	public function add_waste_type()
	{
		$data = [
			'nama_jenis' => $this->input->post('nama_jenis'),
			'id_kategori' => $this->input->post('id_kategori'),
		];
		$this->Admin_model->insert_waste_type($data);
		$this->session->set_flashdata('success', 'Jenis sampah berhasil ditambahkan.');
		redirect('admin/waste_types');
	}

	public function edit_waste_type($id)
	{
		$data = [
			'nama_jenis' => $this->input->post('nama_jenis'),
			'id_kategori' => $this->input->post('id_kategori'),
		];
		$this->Admin_model->update_waste_type($id, $data);
		$this->session->set_flashdata('success', 'Jenis sampah berhasil diperbarui.');
		redirect('admin/waste_types');
	}

	public function delete_waste_type($id)
	{
		$this->Admin_model->delete_waste_type($id);
		$this->session->set_flashdata('success', 'Jenis sampah berhasil dihapus.');
		redirect('admin/waste_types');
	}
}
