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
            <a href="{{ route('administrator.manajemen_akun/kelola_user.create') }}" class="btn btn-success float-right"><i
                    class="fas fa-fw fa-plus-circle"></i> Tambah User</a>
            <h5 class="m-0 font-weight-bold text-primary">Kelola User</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="dataTable">
                <thead class="bg-gradient-primary text-white">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($user as $u)
                        <tr style="text-align: center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <div>
                                    <a href="{{ route('administrator.manajemen_akun/kelola_user.edit', $u->id) }}"
                                        class="btn btn-sm btn-success">Edit User</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#hapusModal{{ $u->id }}">Hapus User</button>
                                </div>
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapusModal{{ $u->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="hapusModalLabel{{ $u->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel{{ $u->id }}">
                                                    Konfirmasi
                                                    Hapus User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus User ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <form
                                                    action="{{ route('administrator.manajemen_akun/kelola_user.destroy', $u->id) }}"
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
