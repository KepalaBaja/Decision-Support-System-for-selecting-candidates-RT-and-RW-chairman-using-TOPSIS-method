@extends('layouts.admin.master')

@section('content')
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @for ($i = 1; $i <= 5; $i++)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Data Penilaian - Penilai {{ $i }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable{{ $i }}"
                        width="100%" cellspacing="0">
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
                                $dataExists = false;
                            @endphp
                            @foreach ($calon as $item)
                                @if ($item->dataPenilaian->isNotEmpty())
                                    @php
                                        $dataExists = true;
                                    @endphp
                                    <tr style="text-align: center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama_calon }}</td>
                                        @foreach ($kriteria->sortBy('kode_kriteria') as $kriteriaItem)
                                            @php
                                                $penilaian = $item->dataPenilaian
                                                    ->where('id_kriteria', $kriteriaItem->kriteria_id)
                                                    ->where('penilai_id', $i)
                                                    ->first();
                                                $nilai = $penilaian ? $penilaian->nilai : 0;
                                            @endphp
                                            <td>{{ $nilai }}</td>
                                        @endforeach
                                    </tr>
                                @endif
                            @endforeach
                            @if (!$dataExists)
                                <tr>
                                    <td colspan="{{ $kriteria->count() + 2 }}" class="text-center">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endfor

    {{-- Tabel Rekapitulasi --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Rekapitulasi</h5>
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
                        @if (!$dataExists)
                            <tr>
                                <td colspan="{{ $kriteria->count() + 2 }}" class="text-center">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>





@endsection
