<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model {

    // Total setoran diterima oleh agent
    public function get_total_setoran($id_agent) {
        return $this->db->where('id_agent', $id_agent)
                        ->count_all_results('transaksi_setoran');
    }

    // Total berat dari semua setoran ke agent
    public function get_total_waste($id_agent) {
        $query = $this->db->select_sum('ds.berat')
                          ->from('detail_setoran ds')
                          ->join('transaksi_setoran ts', 'ts.id_setoran = ds.id_setoran', 'left')
                          ->where('ts.id_agent', $id_agent)
                          ->get()
                          ->row();
        return $query && $query->berat ? $query->berat : 0;
    }

    // Daftar user yang setor ke agent ini
    public function get_my_users($id_agent) {
        $query = $this->db->select('u.id_user, u.nama, u.email, u.username, COUNT(ts.id_setoran) as total_setoran, SUM(ts.total_poin) as total_poin')
                          ->from('transaksi_setoran ts')
                          ->join('users u', 'u.id_user = ts.id_user', 'left')
                          ->where('ts.id_agent', $id_agent)
                          ->group_by('u.id_user')
                          ->get();
        return $query->result_array();
    }

    // Statistik bulanan sampah agent
    public function get_waste_trends($id_agent) {
        $query = $this->db->select('MONTH(ts.tanggal_setor) as bulan, SUM(ds.berat) as total_berat')
                          ->from('detail_setoran ds')
                          ->join('transaksi_setoran ts', 'ts.id_setoran = ds.id_setoran', 'left')
                          ->where('ts.id_agent', $id_agent)
                          ->group_by('MONTH(ts.tanggal_setor)')
                          ->order_by('bulan', 'ASC')
                          ->get();
        return $query->result_array();
    }

    public function get_agent_id($user_id)
    {
        $this->db->select('id_agent');
        $this->db->where('id_user', $user_id);
        $result = $this->db->get('agent')->row();
        return $result ? $result->id_agent : null;
    }

    public function get_transactions($agent_id)
    {
        $this->db->select('transaksi_setoran.*, users.name as user_name');
        $this->db->from('transaksi_setoran');
        $this->db->join('users', 'users.id_user = transaksi_setoran.id_user');
        $this->db->where('transaksi_setoran.id_agent', $agent_id);
        $this->db->order_by('tanggal_setor', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_agent_profile($user_id)
    {
        $this->db->select('users.*, agent.wilayah, agent.latitude, agent.longitude');
        $this->db->from('users');
        $this->db->join('agent', 'users.id_user = agent.id_user');
        $this->db->where('users.id_user', $user_id);
        return $this->db->get()->row_array();
    }

    public function update_profile($user_id, $agent_data, $user_data)
    {
        $this->db->trans_start();
        
        // Update tabel users
        $this->db->where('id_user', $user_id);
        $this->db->update('users', $user_data);

        // Update tabel agent
        $this->db->where('id_user', $user_id);
        $this->db->update('agent', $agent_data);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}