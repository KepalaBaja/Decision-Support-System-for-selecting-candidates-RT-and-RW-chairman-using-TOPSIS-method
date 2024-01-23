<?php

namespace App\Http\Controllers;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::orderby('kode_kriteria', 'asc')->get();
        return view('admin.kelola_kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'jenis_kriteria' => 'required',
        ]);
        $kriteria = Kriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_kriteria' => $request->jenis_kriteria,

        ]);

        return redirect()->route('kelola_kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kriteria_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kriteria_id)
    {
        $kriteria = Kriteria::findorfail($kriteria_id);
        return view('admin.kelola_kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kriteria_id)
    {
        $this->validate($request, [
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'jenis_kriteria' => 'required',
        ]);
        $kriteria = [
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_kriteria' => $request->jenis_kriteria,
        ];
        Kriteria::where('kriteria_id', $kriteria_id)->update($kriteria);
        return redirect()->route('kelola_kriteria.index')->with('success', 'Kriteria berhasil diperbarui');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kriteria_id)
    {
        $kriteria = Kriteria::findorfail($kriteria_id);
        $kriteria->delete();
        return redirect()->back()->with('success', 'Kriteria berhasil dihapus');    
    }
}