<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        $data['page'] = 'dashboard'; // biar dipanggil via layout
        $data['user'] = [
            'name' => 'John Doe',
            'role' => 'Regular User',
            'avatar' => 'https://via.placeholder.com/40'
        ];

        $data['stats'] = [
            'total_collections' => 23,
            'points' => 1240,
            'active_requests' => 2,
            'monthly_goal' => 78
        ];

        $data['recent_activity'] = [
            ['date' => '2024-01-15', 'amount' => '5.2 kg', 'by' => 'Maria Garcia'],
            ['date' => '2024-01-12', 'amount' => '3.8 kg', 'by' => 'John Smith'],
            ['date' => '2024-01-10', 'amount' => '7.1 kg', 'by' => 'David Chen'],
        ];

        $this->load->view('user/layout', $data);
    }
    
    public function waste_banks() {
        $data['page'] = 'waste_banks';

        // Dummy data user (sementara, nanti bisa ambil dari session)
        $data['user'] = [
            'name' => 'John Doe',
            'role' => 'Regular User'
        ];

        // Dummy data centers
        $data['centers'] = [
            ['id'=>1, 'name'=>'Center A', 'distance'=>'1.2 km', 'type'=>'Plastic', 'favorite'=>true],
            ['id'=>2, 'name'=>'Center B', 'distance'=>'2.5 km', 'type'=>'Paper', 'favorite'=>false],
            ['id'=>3, 'name'=>'Center C', 'distance'=>'3.1 km', 'type'=>'Metal', 'favorite'=>true],
        ];

        $this->load->view('user/layout', $data);
    }

    public function transactions() {
        $data['page'] = 'transactions';

        // Dummy data user
        $data['user'] = [
            'name' => 'John Doe',
            'role' => 'Regular User'
        ];

        // Dummy data transaksi
        $data['transactions'] = [
            ['id'=>'TX001', 'date'=>'2025-09-30', 'waste_type'=>'Plastic', 'agent'=>'Agent A', 'weight'=>'2.5kg', 'location'=>'Center A', 'points'=>20, 'earnings'=>5.5, 'status'=>'Completed'],
            ['id'=>'TX002', 'date'=>'2025-09-29', 'waste_type'=>'Paper', 'agent'=>'Agent B', 'weight'=>'1.2kg', 'location'=>'Center B', 'points'=>10, 'earnings'=>2.3, 'status'=>'Pending'],
        ];

        $this->load->view('user/layout', $data);
    }


    public function profile() {
        $data['page']  = "profile"; 

        // Dummy user data
        $data['user'] = [
            'name'    => 'John Doe',
            'role'    => 'Community Member',
            'email'   => 'john.doe@example.com',
            'phone'   => '+1-555-0123',
            'address' => '123 Main Street, Downtown District',
            'bio'     => 'Environmental enthusiast committed to sustainable waste management',
            'member_since' => 'Jan 2024'
        ];

        // Dummy stats
        $data['stats'] = [
            'collections'     => 23,
            'points'          => 1240,
            'member_since'    => 'Jan 2024',
            'waste_collected' => '156 '
        ];

        // Load profile view via layout
        $this->load->view('user/layout', [
            'content' => $this->load->view('user/profile', $data, TRUE)
        ]);
    }
}
