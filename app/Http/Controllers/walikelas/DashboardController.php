<?php

namespace App\Http\Controllers\walikelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Walikelas'
        ];
        return view('walikelas.dashboard.index', $data);
    }
}
