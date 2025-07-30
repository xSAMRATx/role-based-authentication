<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }

    public function hr()
    {
        return view('dashboard.hr');
    }

    public function employee()
    {
        return view('dashboard.employee');
    }
}
