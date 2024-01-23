<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.kelola_user.index', compact('user'));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_user.create');
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

        User::create($validatedData);

        return redirect()->route('administrator.manajemen_akun/kelola_user')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.kelola_user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.kelola_user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $user = User::findOrFail($id);

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

    $user->update($validatedData);

    return redirect()->route('administrator.manajemen_akun/kelola_user')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('administrator.manajemen_akun/kelola_user')->with('success', 'User berhasil dihapus');
    }
}