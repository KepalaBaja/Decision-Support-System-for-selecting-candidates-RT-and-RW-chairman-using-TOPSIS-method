@extends('layouts.user.master')

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

    <div class="card shadow mb-4" style="height:400px;">
        <div class="card-header py-3">
            @if ($pendaftaran->isEmpty())
                <a href="{{ route('pendaftaran_rt_rw.create') }}" class="btn btn-primary float-right">Daftar Jadi Calon
                    RT/RW</a>
            @endif
            <h5 class="m-0 font-weight-bold text-primary">Pendaftaran RT/RW</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-gradient-primary text-white">
                    <tr style="text-align: center">
                        <th>Berkas Pendaftaran</th>
                        <th style="width: 300pt">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftaran as $p)
                        <tr style="text-align: center">
                            <td style="width: 350pt">{{ $p->nama_lengkap }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('pendaftaran_rt_rw.detail_user', $p->id) }}"
                                        class="btn btn-sm btn-success">Detail Pendaftaran</a>
                                    <a href="{{ route('pendaftaran_rt_rw.edit', $p->id) }}"
                                        class="btn btn-sm btn-primary">Edit Pendaftaran</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#hapusModal{{ $p->id }}">Hapus Pendaftaran</button>
                                </div>
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapusModal{{ $p->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="hapusModalLabel{{ $p->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel{{ $p->id }}">Konfirmasi
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
@endsection
