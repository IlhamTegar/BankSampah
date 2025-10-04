<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index()
    {
        $data['summary'] = ["total_waste"=>2203,"active_agents"=>26];
        $data['waste_stats'] = [
            ["name"=>"Plastic","amount"=>328],
            ["name"=>"Organic","amount"=>995],
            ["name"=>"Paper","amount"=>450],
            ["name"=>"Metal","amount"=>120],
        ];
        $data['monthly_stats'] = [
            ["month"=>"January","amount"=>350],
            ["month"=>"February","amount"=>420],
            ["month"=>"March","amount"=>390],
            ["month"=>"April","amount"=>480],
        ];
        $data['agents'] = [
            ["name"=>"Bank Sampah Sejahtera","lat"=>-6.2,"lng"=>106.8,"count"=>15,"area"=>"Downtown"],
            ["name"=>"Bank Sampah Hijau Lestari","lat"=>-6.25,"lng"=>106.82,"count"=>8,"area"=>"Suburban"],
            ["name"=>"Bank Sampah Bersih Indah","lat"=>-6.23,"lng"=>106.85,"count"=>3,"area"=>"City Center"],
        ];

        // kasih tahu layout file mana yg jadi konten
        $data['content'] = 'landing';

        // kirim semua data ke layout
        $this->load->view('layout', $data);
    }
}
