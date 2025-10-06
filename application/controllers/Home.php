<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Pastikan database dan model dimuat
        $this->load->database();
        $this->load->model('Home_model');
    }

    public function index()
    {
        // 🔹 Ambil data summary
        $data['summary'] = [
            'total_waste'   => $this->Home_model->get_total_waste(),
            'active_agents' => $this->Home_model->get_active_agents()
        ];

        // 🔹 Ambil statistik per jenis sampah (pie chart)
        $waste_stats = $this->Home_model->get_waste_by_type();
        $data['waste_stats'] = [];
        foreach ($waste_stats as $ws) {
            $data['waste_stats'][] = [
                'name'   => $ws['name'],
                'amount' => $ws['amount'] ? (float)$ws['amount'] : 0
            ];
        }

        // 🔹 Ambil statistik bulanan (bar chart)
        $monthly_stats = $this->Home_model->get_monthly_waste();
        $data['monthly_stats'] = [];
        foreach ($monthly_stats as $ms) {
            $data['monthly_stats'][] = [
                'month'  => $ms['month'],
                'amount' => $ms['amount'] ? (float)$ms['amount'] : 0
            ];
        }

        // 🔹 Ambil daftar agen untuk tabel dan peta
        $agents = $this->Home_model->get_agents();
        $data['agents'] = [];
        foreach ($agents as $a) {
            $data['agents'][] = [
                'name'   => $a['name'],
                'area'   => $a['area'],
                'status' => $a['status'],
                'lat'    => isset($a['lat']) ? (float)$a['lat'] : -6.2,
                'lng'    => isset($a['lng']) ? (float)$a['lng'] : 106.816666
            ];
        }

        // 🔹 Tambahan data untuk layout
        $data['title']   = "Garbage Bank - Home";
        $data['content'] = 'landing';

        // 🔹 Muat layout utama
        $this->load->view('layout', $data);
    }
}
