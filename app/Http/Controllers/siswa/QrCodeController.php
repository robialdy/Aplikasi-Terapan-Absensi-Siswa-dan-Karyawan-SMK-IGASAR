<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Diri',
        ];
        return view('siswa.qr_code.index', $data);
    }
}
