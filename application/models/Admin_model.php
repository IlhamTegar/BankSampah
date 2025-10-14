<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    // --- FUNGSI UNTUK DASHBOARD ---

    public function get_total_users()
    {
        return $this->db->where('role', 'user')->count_all_results('users');
    }

    public function get_total_agents()
    {
        return $this->db->count_all_results('agent');
    }

    public function get_total_waste_collected()
    {
        $this->db->select_sum('total_setoran', 'total');
        $query = $this->db->get('transaksi_setoran');
        return $query->row()->total ?: 0;
    }
    
    public function get_monthly_waste_trend()
    {
        $this->db->select("DATE_FORMAT(tanggal_setor, '%Y-%m') as month, SUM(total_setoran) as total");
        $this->db->from('transaksi_setoran');
        $this->db->group_by("DATE_FORMAT(tanggal_setor, '%Y-%m')");
        $this->db->order_by('month', 'ASC');
        $this->db->limit(6);
        return $this->db->get()->result_array();
    }

    public function get_recent_transactions()
    {
        $this->db->select('transaksi_setoran.*, users.nama as user_name, agent.wilayah');
        $this->db->from('transaksi_setoran');
        $this->db->join('users', 'users.id_user = transaksi_setoran.id_user');
        $this->db->join('agent', 'agent.id_agent = transaksi_setoran.id_agent');
        $this->db->order_by('tanggal_setor', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result_array();
    }


    // --- FUNGSI UNTUK MANAJEMEN AGEN ---

    public function get_all_agents()
    {
        // PERBAIKAN DI SINI: 'users.name' diubah menjadi 'users.nama'
        $this->db->select('users.nama as name, users.email, agent.*');
        $this->db->from('agent');
        $this->db->join('users', 'users.id_user = agent.id_user');
        return $this->db->get()->result_array();
    }
    
    public function get_pending_agents()
    {
        // PERBAIKAN DI SINI: 'users.name' diubah menjadi 'users.nama'
        $this->db->select('users.nama as name, users.email, agent.*');
        $this->db->from('agent');
        $this->db->join('users', 'users.id_user = agent.id_user');
        $this->db->where('agent.status', 'pending');
        return $this->db->get()->result_array();
    }

    public function update_agent_status($id_agent, $status)
    {
        $this->db->where('id_agent', $id_agent);
        $this->db->update('agent', ['status' => $status]);
    }

    // --- FUNGSI UNTUK MANAJEMEN NASABAH ---
    public function get_all_users()
    {
        $this->db->where('role', 'user');
        return $this->db->get('users')->result_array();
    }

    // --- FUNGSI UNTUK DATA MASTER (JENIS SAMPAH) ---
    public function get_all_waste_types()
    {
        return $this->db->get('jenis_sampah')->result_array();
    }

    public function insert_waste_type($data)
    {
        return $this->db->insert('jenis_sampah', $data);
    }

    public function get_waste_type_by_id($id)
    {
        return $this->db->get_where('jenis_sampah', ['id_jenis' => $id])->row_array();
    }

    public function update_waste_type($id, $data)
    {
        $this->db->where('id_jenis', $id);
        return $this->db->update('jenis_sampah', $data);
    }

    public function delete_waste_type($id)
    {
        $this->db->where('id_jenis', $id);
        return $this->db->delete('jenis_sampah');
    }
}
