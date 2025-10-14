<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// PERBAIKAN: Mengubah nama class dari 'User' menjadi 'User_model'
class User_model extends CI_Model {

    // --- FUNGSI UNTUK DASHBOARD ---

    public function get_user_balance($user_id)
    {
        $this->db->select('saldo');
        $this->db->where('id_user', $user_id);
        $query = $this->db->get('users');
        $row = $query->row();
        return $row ? $row->saldo : 0;
    }

    public function get_user_points($user_id)
    {
        $this->db->select('poin');
        $this->db->where('id_user', $user_id);
        $query = $this->db->get('users');
        $row = $query->row();
        return $row ? $row->poin : 0;
    }
    
    public function count_user_transactions($user_id)
    {
        $this->db->where('id_user', $user_id);
        return $this->db->count_all_results('transaksi_setoran');
    }

    public function get_user_transactions($user_id, $limit = null)
    {
        $this->db->select('ts.*, a.wilayah as agent_area, u_agent.nama as agent_name');
        $this->db->from('transaksi_setoran ts');
        $this->db->join('agent a', 'a.id_agent = ts.id_agent', 'left');
        $this->db->join('users u_agent', 'u_agent.id_user = a.id_user', 'left');
        $this->db->where('ts.id_user', $user_id);
        $this->db->order_by('ts.tanggal_setor', 'DESC');
        if ($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result_array();
    }
    
    public function get_total_waste_by_user($user_id)
    {
        $this->db->select_sum('total_berat');
        $this->db->where('id_user', $user_id);
        $query = $this->db->get('transaksi_setoran');
        $row = $query->row();
        return $row->total_berat ?? 0;
    }

    // --- FUNGSI UNTUK HALAMAN BANK SAMPAH ---

    public function get_all_active_agents()
    {
        $this->db->select('users.nama as name, agent.wilayah, agent.latitude, agent.longitude');
        $this->db->from('agent');
        $this->db->join('users', 'users.id_user = agent.id_user');
        $this->db->where('agent.status', 'aktif');
        return $this->db->get()->result_array();
    }

    // --- FUNGSI UNTUK HALAMAN PROFIL ---

    public function get_user_profile($user_id)
    {
        $this->db->where('id_user', $user_id);
        return $this->db->get('users')->row_array();
    }

    public function update_profile($user_id, $data)
    {
        $this->db->where('id_user', $user_id);
        return $this->db->update('users', $data);
    }
    
    // --- FUNGSI UNTUK REGISTRASI ---
    
    public function check_email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }
    
    public function register($data_user, $data_agent = null)
    {
        $this->db->trans_start();

        $this->db->insert('users', $data_user);
        $user_id = $this->db->insert_id();

        if ($data_agent !== null) {
            $data_agent['id_user'] = $user_id;
            $this->db->insert('agent', $data_agent);
        }

        $this->db->trans_complete();

        return ($this->db->trans_status() === FALSE) ? false : $user_id;
    }
}

