<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $validasi = Pendaftaran::all();
        $calon = Calon::all();
        return view('admin.validasi_calon.index', compact('validasi','calon'));
    }    

    /**
     * Show the form for creating a new resource.
     */

    public function accept($calon_id)
    {
        $calon = Calon::findOrFail($calon_id);
        $calon->status = 'accepted';
        $calon->save();

        return redirect()->route('administrator.validasi_calon.index')->with('success', 'Validasi diterima.');
    }

    public function reject($calon_id)
    {
        $calon = Calon::findOrFail($calon_id);
        $calon->status = 'rejected';
        $calon->save();

        return redirect()->route('administrator.validasi_calon.index')->with('success', 'Validasi ditolak.');
    }

    public function terbitkan()
    {
        session(['status_terbit' => true]);

        return redirect()->route('administrator.data_hasil_akhir')->with('status', 'Data hasil akhir telah diterbitkan.');
    }

    public function tarik_terbitkan()
    {
        session(['status_terbit' => false]);

        return redirect()->route('administrator.data_hasil_akhir')->with('status', 'Data hasil akhir telah ditarik.');
    }





}