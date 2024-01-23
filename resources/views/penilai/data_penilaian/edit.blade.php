@extends('layouts.penilai.master')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('penilai.data_penilaian.index') }}">Penilaian Calon</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Nilai</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Edit Nilai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('penilai.data_penilaian.update_penilai', ['nilai_id' => $nilai->nilai_id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="calon">Nama Calon</label>
                    <input type="text" name="calon" class="form-control" value="{{ $calon->nama_calon }}" readonly>
                </div>
                <table class="table table-bordered">
                    <thead style="text-align: center" class="bg-gradient-primary text-white">
                        <tr>
                            <th width=150pt>Kode Kriteria</th>
                            <th width=300pt>Nama Kriteria</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria->sortBy('kode_kriteria') as $kriteriaItem)
                            <tr>
                                <td style="text-align: center">{{ $kriteriaItem->kode_kriteria }}</td>
                                <td style="text-align: center">{{ $kriteriaItem->nama_kriteria }}</td>
                                <td>
                                    @php
                                        // Ambil penilaian sesuai dengan penilai yang sedang login
                                        $penilaian = $calon->dataPenilaian
                                            ->where('id_kriteria', $kriteriaItem->kriteria_id)
                                            ->where('penilai_id', Auth::guard('penilaiMiddle')->user()->id)
                                            ->first();
                                        $nilai = $penilaian ? $penilaian->nilai : 0;
                                    @endphp
                                    <input type="number" name="nilai[]" class="form-control" placeholder="1-10"
                                        value="{{ $nilai }}" required>
                                    <input type="hidden" name="kriteria_id[]" value="{{ $kriteriaItem->kriteria_id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    <button class="btn btn-primary">Update Nilai</button>
                    <a href="{{ route('penilai.data_penilaian.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
