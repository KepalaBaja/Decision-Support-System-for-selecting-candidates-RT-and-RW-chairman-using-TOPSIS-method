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
            {{-- <a href="{{ route('kelola_calon.create') }}" class="btn btn-success float-right"><i
                    class="fas fa-fw fa-plus-circle"></i>
                Tambah Calon</a> --}}
            <h5 class="m-0 font-weight-bold text-primary">Kelola Calon</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable">
                    <thead class="bg-gradient-primary text-white">
                        <tr style="text-align: center">
                            <th width=5px>No</th>
                            <th width=200px>Nama Calon</th>
                            <th width=10px>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sortedCalon = $calon->sortBy('calon_id');
                            $no = 1;
                        @endphp
                        @foreach ($sortedCalon as $key => $item)
                            @if ($item->status != 'pending')
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_calon }}</td>
                                    <td>
                                        <div>
                                            <form id="deleteForm"
                                                action="{{ route('kelola_calon.destroy', $item->calon_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('kelola_calon.edit', $item->calon_id) }}"
                                                    class="btn btn-sm btn-primary">Edit Calon</a>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="showDeleteModal()">Hapus Calon</button>
                                            </form>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog"
                                                aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin akan menghapus nama calon ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="deleteCalon()">Hapus</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                function showDeleteModal() {
                                                    $('#hapusModal').modal('show');
                                                }

                                                function deleteCalon() {
                                                    document.getElementById('deleteForm').submit();
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
