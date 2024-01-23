@extends('layouts.penilai.master')

@section('content')

    {{-- Tabel Data Hasil Akhir --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Data Hasil Akhir</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive table-hover table-striped">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0" style="text-align: center">
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
                            $dataExists = false;
                        @endphp
                        @if (empty($calon) || empty($nilaiPreferensi) || empty($ranking))
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data</td>
                            </tr>
                        @else
                            @foreach ($nilaiPreferensi as $calonId => $preferensi)
                                @php
                                    $calonItem = $calon->firstWhere('calon_id', $calonId);
                                @endphp
                                @if ($calonItem && $calonItem->status === 'calon')
                                    @php
                                        $dataExists = true;
                                    @endphp
                                    <tr>
                                        <td>{{ $calonItem->nama_calon }}</td>
                                        <td>{{ number_format($preferensi, 3) }}</td>
                                        <td>{{ $ranking }}</td>
                                    </tr>
                                    @php
                                        $ranking++;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if (!$dataExists)
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
