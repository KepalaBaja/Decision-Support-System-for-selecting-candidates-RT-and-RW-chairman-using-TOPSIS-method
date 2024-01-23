<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calon = Calon::orderby('calon_id', 'asc')->get();
        return view('admin.kelola_calon.index', compact('calon'));
    }

    public function index_user()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil calon berdasarkan user yang login
        $calon = Calon::where('calon_id', $user->id)->first();

        // Kirim data status dan calon ke view
        return view('user.status_validasi.index', compact('calon', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_calon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_calon' => 'required',
        ]);
        $calon = Calon::create([
            'nama_calon' => $request->nama_calon,
        ]);

        return redirect()->route('kelola_calon.index')->with('success', 'Calon berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $calon_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $calon_id)
    {
        $calon = Calon::findorfail($calon_id);
        return view('admin.kelola_calon.edit', compact('calon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $calon_id)
    {
        $this->validate($request, [
            'nama_calon' => 'required',
        ]);
        $calon = [
            'nama_calon' => $request->nama_calon,
        ];
        Calon::where('calon_id', $calon_id)->update($calon);
        return redirect()->route('kelola_calon.index')->with('success', 'Calon berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $calon_id)
    {
        $calon = Calon::findorfail($calon_id);
        $calon->delete();
        return redirect()->back()->with('success', 'Calon berhasil dihapus');
    }
}