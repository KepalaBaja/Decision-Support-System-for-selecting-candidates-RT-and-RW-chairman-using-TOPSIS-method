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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Data Pendaftaran RT/RW</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width="5px">No</th>
                            <th width="200px">Nama Calon</th>
                            <th width="10px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($pendaftaran as $p)
                            <tr style="text-align: center">
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->nama_lengkap }}</td>
                                <td>
                                    <div>
                                        <a href="{{ route('administrator.data_pendaftaran_rt_rw.detail', $p->id) }}"
                                            class="btn btn-sm btn-success">Detail Calon</a>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#hapusModal{{ $p->id }}">Hapus Berkas</button>
                                    </div>
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusModal{{ $p->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="hapusModalLabel{{ $p->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel{{ $p->id }}">
                                                        Konfirmasi
                                                        Hapus Berkas</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus berkas ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <form action="{{ route('pendaftaran_rt_rw.destroy', $p->id) }}"
                                                        method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="text-align: center">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
