<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    // Tampilkan halaman admin.about
    public function index()
    {
        return view('admin.about');
    }
}
