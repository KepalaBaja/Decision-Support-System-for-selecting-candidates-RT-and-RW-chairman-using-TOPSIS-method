<?php

namespace App\Http\Controllers\Penilai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('penilaiMiddle');
    }

    public function index()
    {
        return view('penilai.dashboard_penilai');
    }
}