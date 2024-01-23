<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Calon;
use App\Models\DataPenilaian;
use App\Models\Penilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;


class DataPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $calon = Calon::all();
        $nilai = DataPenilaian::orderby('nilai')->get();

        return view('admin.data_penilaian.index', compact('calon','kriteria','nilai'));
    }
    public function index_penilai()
    {
        // Ambil informasi penilai yang sedang login
        $penilai = Auth::guard('penilaiMiddle')->user();

        // Ambil calon yang telah dinilai oleh penilai_id tertentu
        $calon = Calon::with(['dataPenilaian' => function ($query) use ($penilai) {
            $query->where('penilai_id', $penilai->id);
        }])->get();

        $kriteria = Kriteria::all();

        return view('penilai.data_penilaian.index', compact('calon', 'kriteria', 'penilai'));
    }

    
    /**
     * Show the form for creating a new resource.
     */

    public function create_penilai()
    {
        $kriteria = Kriteria::all();
        $calon = Calon::all();
        $nilai = DataPenilaian::all();
        $penilai = Auth::user();
        
        return view('penilai.data_penilaian.create', compact('calon', 'kriteria', 'nilai'));
    }

    public function store_penilai(Request $request)
    {
        $this->validate($request, [
            'calon_id' => 'required|exists:calons,calon_id',
            'nilai.*' => 'required|numeric',
            'kriteria_id.*' => 'required|exists:kriterias,kriteria_id',
        ]);

        $calon_id = $request->calon_id;
        $nilai = $request->nilai;
        $kriteria_id = $request->kriteria_id;
        
        // Ambil informasi penilai yang sedang login
        $penilai = Auth::guard('penilaiMiddle')->user();

        // Lakukan logika penyimpanan nilai
        foreach ($kriteria_id as $key => $id) {
            DataPenilaian::create([
                'id_calon' => $calon_id,
                'id_kriteria' => $id,
                'penilai_id' => $penilai->id,
                'nilai' => $nilai[$key],
            ]);
        }

        return redirect()->route('penilai.data_penilaian.index')->with('success', 'Penilaian berhasil ditambahkan');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function edit_penilai($id_calon)
    {
        $calon = Calon::findOrFail($id_calon);
        $kriteria = Kriteria::all();
        $nilai = DataPenilaian::where('id_calon', $id_calon)->firstOrFail();
        $penilai = Auth::guard('penilaiMiddle')->user();

    
        return view('penilai.data_penilaian.edit', compact('calon', 'kriteria', 'nilai'));
    }


    public function update_penilai(Request $request, $nilai_id)
    {
    $request->validate([
        'nilai.*' => 'required'
    ]);

    $data_penilaian = DataPenilaian::findOrFail($nilai_id);
    $nilai = $request->input('nilai');
    $kriteria_id = $request->input('kriteria_id');

    foreach ($nilai as $index => $kriteriaNilai) {
        $kriteriaId = $kriteria_id[$index];
        $existingDataPenilaian = DataPenilaian::where('id_kriteria', $kriteriaId)
            ->where('id_calon', $data_penilaian->id_calon)
            ->where('penilai_id', Auth::guard('penilaiMiddle')->user()->id)
            ->first();

        if ($existingDataPenilaian) {
            $existingDataPenilaian->nilai = $kriteriaNilai;
            $existingDataPenilaian->save();
        } else {
            $newDataPenilaian = new DataPenilaian();
            $newDataPenilaian->id_calon = $data_penilaian->id_calon;
            $newDataPenilaian->id_kriteria = $kriteriaId;
            $newDataPenilaian->nilai = $kriteriaNilai;
            $newDataPenilaian->penilai_id = Auth::guard('penilaiMiddle')->user()->id;
            $newDataPenilaian->save();
        }
    }

    return redirect()->route('penilai.data_penilaian.index')->with('success', 'Nilai berhasil diperbarui.');
    }


    public function destroy_penilai($nilai_id)
    {
        $data_penilaian = DataPenilaian::findOrFail($nilai_id);

    }


}
