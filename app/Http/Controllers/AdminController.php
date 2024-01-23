<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Admin::all();
        return view('admin.kelola_admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_admin.create');
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

        Admin::create($validatedData);

        return redirect()->route('administrator.manajemen_akun/kelola_admin')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.kelola_admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.kelola_admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $admin = Admin::findOrFail($id);

    $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:admins,email,' . $id,
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

    $admin->update($validatedData);

    return redirect()->route('administrator.manajemen_akun/kelola_admin')->with('success', 'Admin berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('administrator.manajemen_akun/kelola_admin')->with('success', 'Admin berhasil dihapus');
    }
}