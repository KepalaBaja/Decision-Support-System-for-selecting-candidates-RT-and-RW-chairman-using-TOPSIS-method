@extends('layouts.admin.master')

@section('content')
    {{-- Tabel Data Hasil Akhir --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('administrator.cetakPDF') }}" class="btn btn-primary float-right"><i
                    class="fas fa-fw fa-print"></i>
                Cetak Data</a>
            <h5 class="m-0 font-weight-bold text-primary">Data Hasil Akhir</h5>
        </div>

        {{-- Tabel Belum Terbit --}}
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabbelumterbit">
                    @if (Session::get('status_terbit', false))
                        <div class="alert alert-success" role="alert">
                            <strong>Sukses:</strong> Tabel ini sudah dapat dilihat oleh pengguna.
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            <strong>Peringatan:</strong> Tabel ini belum diterbitkan atau diumumkan kepada pengguna.
                        </div>
                    @endif
                    <div class="table-responsive table-hover table-striped">
                        <table class="table table-bordered" id="belum_terbit_table" width="100%" cellspacing="0"
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
                        <button id="btnTerbitkan"
                            class="btn btn-success float-right @if (Session::get('status_terbit', false)) d-none @endif"
                            onclick="publishResults()">
                            <i class="fas fa-fw fa-check"></i> Terbitkan
                        </button>
                        <button id="btnTarik"
                            class="btn btn-warning float-right @if (!Session::get('status_terbit', false)) d-none @endif"
                            onclick="cancelResults()">
                            <i class="fas fa-fw fa-exclamation-triangle"></i> Tarik Penerbitan
                        </button>
                    </div>
                </div>

                <!-- Modal Terbitkan -->
                <div class="modal fade" id="modalTerbitkan" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Terbitkan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menerbitkan data hasil akhir?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-success"
                                    onclick="redirectTerbitkan()">Terbitkan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tarik Penerbitan -->
                <div class="modal fade" id="modalTarikPenerbitan" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tarik Penerbitan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menarik penerbitan data hasil akhir?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-warning" onclick="redirectTarikPenerbitan()">Tarik
                                    Penerbitan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function publishResults() {
                        $('#modalTerbitkan').modal('show');

                        // Mengganti tombol
                        document.getElementById('btnTerbitkan').classList.add('d-none');
                        document.getElementById('btnTarik').classList.remove('d-none');

                        // Mengganti pesan peringatan
                        document.getElementById('peringatan').innerHTML =
                            '<strong>Sukses:</strong> Tabel ini sudah dapat dilihat oleh pengguna.';
                        document.getElementById('peringatan').classList.remove('alert-warning');
                        document.getElementById('peringatan').classList.add('alert-success');
                    }

                    function cancelResults() {
                        $('#modalTarikPenerbitan').modal('show');

                        // Mengganti tombol
                        document.getElementById('btnTerbitkan').classList.remove('d-none');
                        document.getElementById('btnTarik').classList.add('d-none');

                        // Mengganti pesan peringatan
                        document.getElementById('peringatan').innerHTML =
                            '<strong>Peringatan:</strong> Tabel ini belum diterbitkan atau diumumkan kepada pengguna.';
                        document.getElementById('peringatan').classList.remove('alert-success');
                        document.getElementById('peringatan').classList.add('alert-warning');
                    }


                    function redirectTerbitkan() {
                        $('#modalTerbitkan').modal('hide');

                        // Sembunyikan tabel di tab "Belum Terbit"
                        $('#tabbelumterbit table').addClass('d-none');

                        // Beralih ke tab "Sudah Terbit"
                        $('#tabSudahTerbit').tab('show');

                        // Opsional, Anda juga dapat menggulir ke bagian atas halaman
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'fast');

                        // Sesuaikan dengan route yang sesuai
                        window.location.href = "{{ route('administrator.data_hasil_akhir.terbitkan') }}";
                    }

                    function redirectTarikPenerbitan() {
                        $('#modalTarikPenerbitan').modal('hide');

                        $('html, body').animate({
                            scrollTop: 0
                        }, 'fast');

                        window.location.href = "{{ route('administrator.data_hasil_akhir.tarik_terbitkan') }}";
                    }
                </script>
            @endsection
