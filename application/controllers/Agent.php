<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agent_model');
        
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'agent') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai Agent untuk mengakses halaman ini.');
            redirect(base_url());
        }
    }

    public function index()
    {
        redirect('agent/dashboard');
    }

    public function dashboard()
    {
        // Menggunakan sistem layout yang konsisten
        $data['view_name'] = 'agent/dashboard'; 
        $this->load->view('agent/layout', $data);
    }
    
    public function transactions()
    {
        $user_id = $this->session->userdata('user_id');
        $agent_id = $this->Agent_model->get_agent_id($user_id);
        
        $data['transactions'] = [];
        if ($agent_id) {
            $data['transactions'] = $this->Agent_model->get_transactions($agent_id);
        }
        
        $data['view_name'] = 'agent/transactions';
        $this->load->view('agent/layout', $data);
    }

    public function profile()
    {
        $user_id = $this->session->userdata('user_id');

        if ($this->input->post()) {
            $userData = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
            ];

            $agentData = [
                'wilayah' => $this->input->post('wilayah'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
            ];

            if ($this->input->post('password')) {
                $userData['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            }

            if ($this->Agent_model->update_profile($user_id, $agentData, $userData)) {
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
            }
            redirect('agent/profile');
        }

        $data['profile'] = $this->Agent_model->get_agent_profile($user_id);
        $data['view_name'] = 'agent/profile';
        $this->load->view('agent/layout', $data);
    }
    
    public function my_user()
    {
        $data['view_name'] = 'agent/my_user';
        $this->load->view('agent/layout', $data);
    }
}