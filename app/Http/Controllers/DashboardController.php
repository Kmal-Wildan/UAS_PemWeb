<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [
            'stats' => [
                'total_data' => 128,
                'active_data' => 96,
                'pending' => 18,
                'total_users' => 24,
            ],
        ]);
    }

    public function user()
    {
        return view('dashboard.user', [
            'stats' => [
                'total_data' => 128,
                'active_data' => 96,
                'reports' => 12,
            ],
        ]);
    }
}
