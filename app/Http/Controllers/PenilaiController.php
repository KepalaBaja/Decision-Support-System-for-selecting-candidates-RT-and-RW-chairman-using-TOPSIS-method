<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilai;
use Illuminate\Support\Facades\Hash;


class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilai = Penilai::all();
        return view('admin.kelola_penilai.index', compact('penilai'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_penilai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',

        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);

        Penilai::create($validatedData);

        return redirect()->route('administrator.manajemen_akun/kelola_penilai')->with('success', 'Penilai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penilai = Penilai::findOrFail($id);
        return view('admin.kelola_penilai.show', compact('penilai'));    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penilai = Penilai::findOrFail($id);
        return view('admin.kelola_penilai.edit', compact('penilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penilai = Penilai::findOrFail($id);

    $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:penilais,email,' . $id,
    ];

    // Cek apakah input password tidak kosong
    if (!empty($request->input('password'))) {
        $rules['password'] = 'required|min:8|confirmed';
    }

    $validatedData = $request->validate($rules);

    // Jika input password kosong, hapus aturan validasi password dan hapus nilai password dari data yang divalidasi
    if (empty($request->input('password'))) {
        unset($validatedData['password']);
    } else {
        $validatedData['password'] = Hash::make($validatedData['password']);
    }

    $penilai->update($validatedData);

    return redirect()->route('administrator.manajemen_akun/kelola_penilai')->with('success', 'Penilai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penilai = Penilai::findOrFail($id);
        $penilai->delete();

        return redirect()->route('administrator.manajemen_akun/kelola_penilai')->with('success', 'Penilai berhasil dihapus');
    }
}