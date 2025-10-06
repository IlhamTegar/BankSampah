<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_total_setoran($id_user) {
        return $this->db->where('id_user', $id_user)
                        ->count_all_results('transaksi_setoran');
    }

    public function get_total_poin($id_user) {
        $query = $this->db->select_sum('total_poin')
                          ->where('id_user', $id_user)
                          ->get('transaksi_setoran')
                          ->row();
        return $query && $query->total_poin ? $query->total_poin : 0;
    }

    public function get_recent_setoran($id_user) {
        $query = $this->db->select('ts.*, SUM(ds.berat) as total_berat')
                          ->from('transaksi_setoran ts')
                          ->join('detail_setoran ds', 'ts.id_setoran = ds.id_setoran', 'left')
                          ->where('ts.id_user', $id_user)
                          ->group_by('ts.id_setoran')
                          ->order_by('ts.tanggal_setor', 'DESC')
                          ->limit(5)
                          ->get();
        return $query->result_array();
    }
}
