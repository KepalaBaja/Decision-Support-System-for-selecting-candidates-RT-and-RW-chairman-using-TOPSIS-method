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
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="tabValidasi" data-toggle="tab" href="#validasi_calon">Validasi
                        Calon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabDiterima" data-toggle="tab" href="#validasi_diterima">Diterima</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabDitolak" data-toggle="tab" href="#validasi_ditolak">Ditolak</a>
                </li>
            </ul>
        </div>

        {{-- TAB VALIDASI CALON --}}
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="validasi_calon">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="text-align: center">
                            <thead class="bg-gradient-warning text-white">
                                <tr>
                                    <th width="5px">No</th>
                                    <th width="200px">Nama Calon</th>
                                    <th width="10px">Status</th>
                                    <th width="10px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($calon as $index => $calonItem)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $calonItem->nama_calon }}</td>
                                        <td>
                                            @if ($calonItem->status == 'pending')
                                                <span class="badge badge-warning" style="font-size: 20px;">Menunggu
                                                    Validasi</span>
                                            @elseif ($calonItem->status == 'accepted')
                                                <span class="badge badge-success " style="font-size: 20px;">Diterima</span>
                                            @elseif ($calonItem->status == 'rejected')
                                                <span class="badge badge-danger" style="font-size: 20px;">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('administrator.proses_validasi.accept', $calonItem->calon_id) }}"
                                                class="btn btn-success">Terima</a>
                                            <a href="{{ route('administrator.proses_validasi.reject', $calonItem->calon_id) }}"
                                                class="btn btn-danger">Tolak</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TAB CALON DI TERIMA --}}
                <div class="tab-pane fade" id="validasi_diterima">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="text-align: center">
                            <thead class="bg-gradient-success text-white">
                                <tr>
                                    <th width="5px">No</th>
                                    <th width="200px">Nama Calon</th>
                                    <th width="10px">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($calon->where('status', 'accepted') as $index => $calonDiterima)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $calonDiterima->nama_calon }}</td>
                                        <td>
                                            <span class="badge badge-success">Diterima</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TAB CALON DI TOLAK --}}
                <div class="tab-pane fade" id="validasi_ditolak">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="text-align: center">
                            <thead class="bg-gradient-danger text-white">
                                <tr>
                                    <th width="5px">No</th>
                                    <th width="200px">Nama Calon</th>
                                    <th width="10px">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($calon->where('status', 'rejected') as $index => $calonDitolak)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $calonDitolak->nama_calon }}</td>
                                        <td>
                                            <span class="badge badge-danger">Ditolak</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
