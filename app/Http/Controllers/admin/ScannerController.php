<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function index()
    {
        return view('admin.scanner.index');
    }

    public function scannerSiswa(Request $request)
    {
        $id_user = json_decode($request->barcode);

        echo $id_user;
    }
}

