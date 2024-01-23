@extends('layouts.admin.master')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('kelola_kriteria.create') }}" class="btn btn-success float-right"><i
                    class="fas fa-fw fa-plus-circle"></i> Tambah Kriteria</a>
            <h5 class="m-0 font-weight-bold text-primary">Kelola Kriteria</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="dataTable">
                <thead class="bg-gradient-primary text-white">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Jenis Kriteria</th>
                        <th width="100px" style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kriteria as $key => $item)
                        <tr>
                            <td style="text-align: center" width='50px'>{{ $item->kode_kriteria }}</td>
                            <td>{{ $item->nama_kriteria }}</td>
                            <td width='70px;' style="text-align: center">{{ $item->bobot }}</td>
                            <td width='130px;' style="text-align: center">{{ $item->jenis_kriteria }}</td>
                            <td style="width: 300px; text-align: center">
                                <div class="container">
                                    <a href="{{ route('kelola_kriteria.edit', $item->kriteria_id) }}"
                                        class="btn btn-sm btn-primary">Edit
                                        Kriteria</a>
                                    <form action="{{ route('kelola_kriteria.destroy', $item->kriteria_id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <!-- Tombol Hapus Kriteria -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#hapusModal{{ $item->kriteria_id }}">
                                            Hapus Kriteria
                                        </button>
                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="hapusModal{{ $item->kriteria_id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="hapusModalLabel{{ $item->kriteria_id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="hapusModalLabel{{ $item->kriteria_id }}">Konfirmasi Hapus
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin akan menghapus kriteria ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <form
                                                            action="{{ route('kelola_kriteria.destroy', $item->kriteria_id) }}"
                                                            method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
