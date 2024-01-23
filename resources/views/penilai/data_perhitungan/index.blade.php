@extends('layouts.penilai.master')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session('success') }}
        </div>
    @endif

    @if (Session::has('warning'))
        <div class="alert alert-warning" role="alert">
            {{ Session('warning') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Data Perhitungan</h5>
        </div>
    </div>

    {{-- MATRIKS KEPUTUSAN (X) --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Matriks Keputusan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="rekapTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width="50px">No</th>
                            <th width="200px">Nama Calon</th>
                            @foreach ($kriteria->sortBy('kode_kriteria') as $item)
                                <th>{{ $item->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($calon as $item)
                            @if ($item->dataPenilaian->isNotEmpty())
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_calon }}</td>
                                    @foreach ($kriteria->sortBy('kode_kriteria') as $kriteriaItem)
                                        @php
                                            $penilaian = $item->dataPenilaian
                                                ->whereIn('penilai_id', [1, 2, 3, 4, 5])
                                                ->where('id_kriteria', $kriteriaItem->kriteria_id)
                                                ->sum('nilai');
                                        @endphp
                                        <td>{{ $penilaian }}</td>
                                    @endforeach
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- BOBOT KRITERIA --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Bobot Kriteria (W)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr class="bg-gradient-primary text-white">
                            @foreach ($kriteria as $item)
                                <th style="text-align: center">{{ $item->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($kriteria as $nilaiBobot)
                                <td style="text-align: center">{{ $nilaiBobot->bobot }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TAMBEL PEMBAGI --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Pembagi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            @foreach ($kriteria->sortBy('kode_kriteria') as $kriteriaItem)
                                <th>{{ $kriteriaItem->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center">
                            @foreach ($kriteria->sortBy('kode_kriteria') as $kriteriaItem)
                                <td>{{ number_format($akarKuadratTotal[$kriteriaItem->kriteria_id], 3) }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TABEL PERHITUNGAN MATRIKS NORMALISASI (R) --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Matriks Normalisasi (R)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="matriksNormalisasiTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width="50px">No</th>
                            <th width="200px">Nama Calon</th>
                            @foreach ($kriteria->sortBy('kode_kriteria') as $item)
                                <th>{{ $item->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($calon as $index => $item)
                            @if ($item->dataPenilaian->isNotEmpty())
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_calon }}</td>
                                    @foreach ($matriksNormalisasi[$index] as $nilaiNormalisasi)
                                        <td>{{ number_format($nilaiNormalisasi, 3) }}</td>
                                    @endforeach
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TABEL MATRIKS TERBOBOT (Y) --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Matriks Terbobot (Y)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="matriksBobotTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width="50px">No</th>
                            <th width="200px">Nama Calon</th>
                            @foreach ($kriteria->sortBy('kode_kriteria') as $item)
                                <th>{{ $item->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($matriksBobot as $index => $barisBobot)
                            <tr style="text-align: center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $calon[$index]->nama_calon }}</td>
                                @foreach ($barisBobot as $nilaiBobot)
                                    <td>{{ number_format($nilaiBobot, 3) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TABEL A+ DAN A- --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Solusi Ideal Positif (A+) dan Solusi Ideal Negatif (A-)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width="200px"></th>
                            @foreach ($kriteria->sortBy('kode_kriteria') as $item)
                                <th>{{ $item->kode_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="text-align: center">
                            <td>A+</td>
                            @foreach ($kriteria as $kriteriaItem)
                                <td>{{ number_format($aPlus[$kriteriaItem->kriteria_id], 3) }}</td>
                            @endforeach
                        </tr>
                        <tr style="text-align: center">
                            <td>A-</td>
                            @foreach ($kriteria as $kriteriaItem)
                                <td>{{ number_format($aMinus[$kriteriaItem->kriteria_id], 3) }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- TABEL JARAK SOLUSI IDEAL POSITIF DAN NEGATIF --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Jarak Solusi ideal Positif (D+) dan Negatif (D-)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="jarakTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width="50px">No</th>
                            <th width="200px">Nama Calon</th>
                            <th>Jarak Plus (D+)</th>
                            <th>Jarak Minus (D-)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($calon as $index => $item)
                            @if ($item->dataPenilaian->isNotEmpty())
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_calon }}</td>
                                    <td>{{ number_format($jarakPlus[$index], 3) }}</td>
                                    <td>{{ number_format($jarakMinus[$index], 3) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- TABEL NILAI PREFERENSI --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Nilai Preferensi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="nilaiPreferensiTable" width="100%"
                    cellspacing="0">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width="50px">No</th>
                            <th width="200px">Nama Calon</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            // Mengurutkan nilai preferensi dari besar ke kecil
                            arsort($nilaiPreferensi);
                        @endphp
                        @foreach ($nilaiPreferensi as $index => $nilai)
                            <tr style="text-align: center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $calon[$index]->nama_calon }}</td>
                                <td>{{ number_format($nilai, 3) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

















@endsection
