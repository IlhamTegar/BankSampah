<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // ================== DASHBOARD ==================
    public function dashboard()
    {
        $data['page'] = 'dashboard';
        $data['agent'] = [
            'name'   => 'Agent Smith',
            'role'   => 'Collection Agent',
            'email'  => 'agent.smith@example.com',
            'avatar' => 'https://ui-avatars.com/api/?name=Agent+Smith&background=random'
        ];

        // Dummy data dashboard
        $data['stats'] = [
            'regular_users'     => 24,
            'unpaid_fees'       => 3,
            'service_rating'    => 4.8,
            'reviews'           => 12,
            'monthly_earnings'  => 1245,
            'earnings_this_week'=> 180
        ];

        $data['waste_trends'] = [
            'months'  => ['Jan','Feb','Mar','Apr','May'],
            'plastik' => [20, 30, 25, 40, 35],
            'kertas'  => [15, 18, 22, 25, 28],
            'kaca'    => [5, 7, 6, 9, 10],
            'logam'   => [3, 4, 6, 8, 9],
            'organik' => [40, 35, 45, 50, 55]
        ];

        $data['content'] = 'agent/dashboard';
        $this->load->view('agent/layout', $data);
    }

    // ================== MY USER ==================
    public function my_user()
    {
        $data['page'] = 'my_user';
        $data['agent'] = [
            'name'   => 'Agent Smith',
            'role'   => 'Collection Agent',
            'email'  => 'agent.smith@example.com',
            'avatar' => 'https://ui-avatars.com/api/?name=Agent+Smith&background=random'
        ];

        // Dummy statistik user
        $data['stats'] = [
            'total_users'  => 10,
            'active_users' => 7,
            'unpaid_users' => 2,
            'new_users'    => 1,
        ];

        // Dummy daftar user
        $data['users'] = [
            [
                'name'   => 'Andi Pratama',
                'email'  => 'andi@email.com',
                'status' => 'active',
                'created_at' => '2024-09-01'
            ],
            [
                'name'   => 'Budi Santoso',
                'email'  => 'budi@email.com',
                'status' => 'unpaid',
                'created_at' => '2024-09-10'
            ],
            [
                'name'   => 'Citra Dewi',
                'email'  => 'citra@email.com',
                'status' => 'new',
                'created_at' => '2024-09-20'
            ]
        ];

        $data['content'] = 'agent/my_user';
        $this->load->view('agent/layout', $data);
    }

    // ================== TRANSACTIONS (dummy) ==================
    public function transactions()
    {
        $data['page'] = 'transactions';
        $data['agent'] = [
            'name'   => 'Agent Smith',
            'role'   => 'Collection Agent',
            'email'  => 'agent.smith@example.com',
            'avatar' => 'https://ui-avatars.com/api/?name=Agent+Smith&background=random'
        ];

        $data['transactions'] = [
            ['id'=>1, 'user'=>'Andi', 'amount'=>50, 'date'=>'2024-09-12'],
            ['id'=>2, 'user'=>'Budi', 'amount'=>30, 'date'=>'2024-09-15'],
        ];

        $data['content'] = 'agent/transactions';
        $this->load->view('agent/layout', $data);
    }

    // ================== PROFILE (dummy) ==================
    public function profile()
    {
        $data['page'] = 'profile';
        $data['agent'] = [
            'name'   => 'Agent Smith',
            'role'   => 'Collection Agent',
            'email'  => 'agent.smith@example.com',
            'avatar' => 'https://ui-avatars.com/api/?name=Agent+Smith&background=random'
        ];

        $data['content'] = 'agent/profile';
        $this->load->view('agent/layout', $data);
    }
}
