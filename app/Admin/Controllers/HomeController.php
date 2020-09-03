<?php

namespace App\Admin\Controllers;

class HomeController extends Controller
{
    public function dashboard()
    {
        return view('Admin::home.dashboard');
    }
}
