@extends('layouts.user.master')

@section('content')
    {{-- Tabel Data Hasil Akhir --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Pengumuman Hasil Akhir</h5>
        </div>

        {{-- Tabel Hasil Akhir --}}
        <div class="card-body">
            @php
                $namaCalonLogin = auth()->user()->name;
                $calonAdaDiTabel = false;
            @endphp

            @if (session('status_terbit', false))
                @foreach ($nilaiPreferensi as $index => $nilai)
                    @if ($calon[$index]->nama_calon == $namaCalonLogin)
                        @php $calonAdaDiTabel = true; @endphp
                    @break
                @endif
            @endforeach

            @if ($calonAdaDiTabel)
                <div class="alert alert-success" role="alert">
                    <strong>Sukses:</strong> Tabel hasil akhir sudah dapat dilihat.
                </div>
                <div class="table-responsive table-hover table-striped">
                    <table class="table table-bordered" id="hasil_akhir_table" width="100%" cellspacing="0"
                        style="text-align: center">
                        <thead class="bg-gradient-primary text-white">
                            <tr>
                                <th>Nama Calon</th>
                                <th>Nilai Preferensi</th>
                                <th>Ranking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $ranking = 1;
                                arsort($nilaiPreferensi);
                            @endphp
                            @foreach ($nilaiPreferensi as $index => $nilai)
                                <tr style="text-align: center">
                                    <td>{{ $calon[$index]->nama_calon }}</td>
                                    <td>{{ number_format($nilai, 3) }}</td>
                                    <td>{{ $ranking++ }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    <strong>Peringatan:</strong> Anda belum melalui proses penilaian.
                </div>
            @endif
        @else
            <div class="alert alert-warning" role="alert">
                <strong>Peringatan:</strong> Tabel hasil akhir belum tersedia.
            </div>
        @endif
    </div>
</div>


@endsection
