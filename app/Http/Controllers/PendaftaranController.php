<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Calon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index(){

        $pendaftaran = Pendaftaran::all();
        return view('admin.data_pendaftaran.index',compact('pendaftaran'));

    }

    public function index_user(){
        
        $user = Auth::user();

        // Filter data pendaftaran berdasarkan user yang sedang login
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->get();
        return view('user.pendaftaran.index', compact('pendaftaran'));

    }

    public function create(){

        return view('user.pendaftaran.create');

    }

        public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'telpon' => 'required|max:15',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'berkas' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx'
        ]);

        $userId = Auth::id();

        $calon = Calon::firstOrCreate(['nama_calon' => $request->nama_lengkap],
        ['status' => 'default_value']);

        $pendaftaran = new Pendaftaran([
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telpon' => $request->telpon,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'id_calon' => $calon->id, // Hubungkan dengan ID calon
        ]);

        $pendaftaran->user_id = $userId;

        // Mengunggah berkas jika ada
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $originalName = $file->getClientOriginalName();
            $file->storeAs('public/berkas', $originalName);
            $pendaftaran->berkas = $originalName;
        }
        
        $calon->status = 'pending'; // Atur status menjadi "pending" atau nilai lain sesuai kebutuhan
        $calon->save();
        $pendaftaran->calon()->associate($calon);
        $pendaftaran->save();
        

        return redirect()->route('pendaftaran_rt_rw')->with('success', 'Data berhasil disimpan.');
    }
    
    public function detail($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return redirect()->route('admin.data_pendaftaran_rt_rw')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('admin.data_pendaftaran.detail', compact('pendaftaran'));
    }
    public function detail_user($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return redirect()->route('pendaftaran_rt_rw')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        return view('user.pendaftaran.detail', compact('pendaftaran'));
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findorfail($id);
        return view('user.pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'telpon' => 'required|max:15',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'berkas' => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx'
        ]);

        $userId = Auth::id();

        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return redirect()->route('pendaftaran_rt_rw')->with('error', 'Data tidak ditemukan.');
        }

        $pendaftaran->nama_lengkap = $request->nama_lengkap;
        $pendaftaran->tempat_lahir = $request->tempat_lahir;
        $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
        $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
        $pendaftaran->telpon = $request->telpon;
        $pendaftaran->pendidikan = $request->pendidikan;
        $pendaftaran->pekerjaan = $request->pekerjaan;

        // Mengunggah berkas jika ada
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $originalName = $file->getClientOriginalName();
            $file->storeAs('public/berkas', $originalName);
            $pendaftaran->berkas = $originalName;
        }

        $pendaftaran->save();
    
        return redirect()->route('admin.data_pendaftaran_rt_rw')->with('success', 'Berkas berhasil diupdate.');
    }
    public function update_user(Request $request, $id)
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'telpon' => 'required|max:15',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'berkas' => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx'
        ]);

        $userId = Auth::id();

        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return redirect()->route('pendaftaran_rt_rw')->with('error', 'Data tidak ditemukan.');
        }

        $pendaftaran->nama_lengkap = $request->nama_lengkap;
        $pendaftaran->tempat_lahir = $request->tempat_lahir;
        $pendaftaran->tanggal_lahir = $request->tanggal_lahir;
        $pendaftaran->jenis_kelamin = $request->jenis_kelamin;
        $pendaftaran->telpon = $request->telpon;
        $pendaftaran->pendidikan = $request->pendidikan;
        $pendaftaran->pekerjaan = $request->pekerjaan;

        // Mengunggah berkas jika ada
        if ($request->hasFile('berkas')) {
            $file = $request->file('berkas');
            $originalName = $file->getClientOriginalName();
            $file->storeAs('public/berkas', $originalName);
            $pendaftaran->berkas = $originalName;
        }

        $pendaftaran->save();

        return redirect()->route('pendaftaran_rt_rw')->with('success', 'Data berhasil diperbarui.');
    }

    

    public function destroy($id)
    {
        $pendaftarn = Pendaftaran::findOrFail($id);
        $file = $pendaftarn->berkas;

        if (!empty($file)) {
            $filePath = public_path('uploads/' . $file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $pendaftarn->delete();

        return redirect()->back()->with('success', 'Berkas berhasil dihapus');
    }



}    